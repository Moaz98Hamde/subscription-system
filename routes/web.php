<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataTablesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Auth routes
require __DIR__ . '/auth.php';

Route::redirect('/', '/login', 301);

// Admin routes
Route::controller(AdminController::class)
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/users', 'users')->name('users');
        Route::get('/users/create', 'createUser')->name('users.create');
        Route::get('/users/edit/{user}', 'editUser')->name('users.edit');
        Route::post('/users', 'storeUser')->name('users.store');
        Route::put('/users/{user}', 'updateUser')->name('users.update');
        Route::get('/users/activate/{user}', 'activateUser')->name('users.activate');
        Route::get('/users/deactivate/{user}', 'deactivateUser')->name('users.deactivate');
    });

Route::controller(DataTablesController::class)->group(function () {
    Route::get('/customers', 'customers')->middleware(['auth', 'role:admin'])->name('data-table.customers');
});

// Customer routes
Route::controller(CustomerController::class)
    ->middleware(['auth', 'preventDeactivated'])
    ->group(function () {
        Route::get('/pricing', 'pricing')->middleware(['unsubscribed'])->name('pricing');
        Route::get('/payment-method', 'paymentMethod')->middleware(['unsubscribed'])->name('payment_method');
        Route::post('/subscribe', 'subscribe')->middleware(['unsubscribed'])->name('subscribe');;
        Route::get('/subscribed', 'subscribed')->middleware(['subscribed'])->name('subscribed');
    });
