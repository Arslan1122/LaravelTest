<?php

namespace App\Services;

use App\Mail\OrderEmail;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Stripe;

class CheckoutService
{
    /**
     * @param $request
     * @return void
     */
    public function processCheckoutAndPayment($request): void
    {
        $passwordString = random_string(10);

        //check if user already exists or create new user
        $user = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'name' => $request->full_name,
            'password' => Hash::make($passwordString),
            'email_verified_at' => Carbon::now()
        ]);


        $product = Product::find($request->product_id);

        if(!Auth::check()) {

            Auth::login($user); //login user

            //assign user role according to the product purchase type
            $this->assignUserRole($product, $user);
        }

        $paymentData = $this->processPayment($request, $product);

        //update user card details
        $user->update([
            'stripe_id' => $paymentData->id,
            'pm_type' => $paymentData->payment_method_details->card->brand,
            'pm_last_four' => $paymentData->payment_method_details->card->last4,

        ]);

        //create order details
         Order::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'postal' => $request->postal,
            'order_notes' => $request->order_notes,
            'status' => $paymentData->status,
            'payment_id' =>  $paymentData->id,
        ]);

         //send email to users with the order details
        if($request->email)
            $this->sendEmail($user, $product, $paymentData, $passwordString);
        else
            $this->sendEmail($user, $product, $paymentData);
    }

    /**
     * @param $request
     * @param $product
     * @return \Illuminate\Http\RedirectResponse|Charge
     */
    public function processPayment($request, $product)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $token = $request->stripeToken;

        try {

            $charge = Charge::create([
                'amount' => $product->price * 100, // Amount in cents
                'currency' => 'usd',
                'description' => $product->name,
                'source' => $token,
            ]);


            return $charge;

        } catch (\Stripe\Exception\CardException $e) {
            // Handle card errors
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            // Handle other errors
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * @param $id
     * @return bool
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function refundPayment($id)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $order = Order::where('id', $id)->first();

        $paymentIntentId = $order->payment_id;

        $refund = Refund::create([
            'charge' => $paymentIntentId,
        ]);

        if ($refund->status === 'succeeded') {

            $order->update([
                'status' => 'refunded'
            ]);

            return true;

        } else {
            return false;
        }

    }

    /**
     * @param $user
     * @param $product
     * @param $paymentData
     * @param $passwordString
     * @return void
     */
    private function sendEmail($user, $product, $paymentData, $passwordString=null): void
    {
        $data = [
            'user_name' => $user->name,
            'product_name' => $product->name,
            'price' => $product->price,
            'card_type' => $paymentData->payment_method_details->card->brand,
            'last_four' => $paymentData->payment_method_details->card->last4,
            'password'=> $passwordString
        ];

        Mail::to($user->email)->send(new OrderEmail($data));

    }

    /**
     * @param $product
     * @param $user
     * @return void
     */
    private function assignUserRole($product, $user): void
    {
        switch ($product->customer_type){
            case "b2b":
                $user->assignRole(User::B2B_ROLE);
                break;

            case "b2c":
                $user->assignRole(User::B2C_ROLE);
                break;
        }
    }


}