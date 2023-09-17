<?php

namespace App\Http\Controllers;

use App\Mail\InactiveMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $users = User::whereHas("roles", function($q){
            $q->where("name", User::B2B_ROLE)
            ->orWhere("name", User::B2C_ROLE);
        })->where('status', 1)->get();

        return view('users.index', compact('users'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function inActiveUser($id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $user->update(['status' => 0]);

        $data = [
            'name' => $user->name
        ];

        Mail::to($user->email)->send(new InactiveMail($data));

        return redirect()->back()->with('success', 'User status changed successfully!');
    }
}
