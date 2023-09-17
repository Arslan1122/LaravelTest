<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Event;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        $event = Event::constructFrom($payload);

        if ($event->type === 'charge.failed') {
            $paymentId = $event->data->object->id;

            Order::where('payment_id', $paymentId)->update([
                'status' => 'Payment Revoked'
            ]);

        }

        return response('Webhook Handled', 200);
    }
}
