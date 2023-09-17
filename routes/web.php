<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use \App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

//checkout routes
Route::get('checkout/{slug}', [HomeController::class, 'showCheckoutForm'])->name('show.checkout');
Route::post('checkout', [HomeController::class, 'store'])->name('checkout');

//webhook to handle revoked payment
Route::post('webhooks/stripe', 'StripeWebhookController@handleWebhook');



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //cancel order
    Route::get('cancel-order/{id}', [HomeController::class, 'cancelOrder'])->name('cancel.order');


    //users routes
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('/users/inactive/{id}', [UserController::class, 'inActiveUser'])->name('users.inactive');
    });

});

require __DIR__.'/auth.php';
