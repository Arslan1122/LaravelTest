<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Product;
use App\Services\CheckoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class HomeController extends Controller
{
    public $checkoutService;

    /**
     * @param CheckoutService $checkoutService
     */
    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $products = Product::all();

        return view('welcome', compact('products'));
    }

    /**
     * @param $slug
     * @return View
     */
    public function showCheckoutForm($slug): View
    {
        $product = Product::whereSlug($slug)->first();

        return view('checkout', compact('product'));
    }

    /**
     * @param OrderRequest $request
     * @return RedirectResponse
     */
    public function store(OrderRequest $request): RedirectResponse
    {
        $this->checkoutService->processCheckoutAndPayment($request);

        return redirect()->route('dashboard');

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelOrder($id): RedirectResponse
    {

        if($this->checkoutService->refundPayment($id)) {

            return redirect()->back()->with('success', 'Payment refunded successfully!');
        }

        return redirect()->back()->with('error', 'Payment refund failed!');

    }


}
