<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $role = Auth::user()->getRoleNames()->first();

        if($role != User::ADMIN_ROLE) {

            $orders = Order::where('user_id', Auth::id())
                ->with(['user', 'product'])
                ->get();

        }
        else {
            $orders = Order::with(['user', 'product'])->get();
        }

        return view('dashboard', compact('orders','role'));
    }
}
