<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Merchant\DashboardController as MerchantDashboardController;
use App\Http\Controllers\Merchant\ProfileController as MerchantProfileController;
use App\Http\Controllers\Merchant\MenuController;
use App\Http\Controllers\Merchant\OrderController as MerchantOrderController;

use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\MerchantController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\MerchantController as CustomerMerchantController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('merchant')
        ->prefix('merchant')
        ->name('merchant.')
        ->group(function () {

            Route::get('/dashboard', [MerchantDashboardController::class, 'index'])
                ->name('dashboard');

            Route::resource('menus', MenuController::class);

            Route::get('/profile', [MerchantProfileController::class, 'show'])
                ->name('profile.show');

            Route::get('/profile/edit', [MerchantProfileController::class, 'edit'])
                ->name('profile.edit');

            Route::put('/profile', [MerchantProfileController::class, 'update'])
                ->name('profile.update');

            Route::resource('orders', MerchantOrderController::class)
                ->only(['index', 'show']);
        });

    Route::prefix('customer')
        ->name('customer.')
        ->group(function () {

            Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('/merchants', [CustomerMerchantController::class, 'index'])
                ->name('merchants.index');

            Route::get('/merchants/{merchant}', [CustomerMerchantController::class, 'show'])
                ->name('merchants.show');

            Route::get('/orders', [CustomerOrderController::class, 'index'])
                ->name('orders.index');

            Route::post('/menus/{menu}/order', [CustomerOrderController::class, 'store'])
                ->name('orders.store');

            Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])
                ->name('orders.show');

            Route::get('/profile', function () {
                return view('customer.profile.show');
            })->name('profile.show');

            Route::get('/profile/edit', [CustomerProfileController::class, 'edit'])
                ->name('profile.edit');

            Route::get('/profile', [CustomerProfileController::class, 'show'])
                ->name('profile.show');

            Route::put('/profile', [CustomerProfileController::class, 'update'])
                ->name('profile.update');
        });
});

require __DIR__ . '/auth.php';
