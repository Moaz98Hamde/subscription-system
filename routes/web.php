<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataTablesController;
use App\Models\User;
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


// Admin routes
Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->middleware(['auth', 'role:admin'])->name('dashboard');
    Route::get('/users', 'users')->middleware(['auth', 'role:admin'])->name('users');
    Route::get('/users/create', 'createUser')->middleware(['auth', 'role:admin'])->name('users.create');
    Route::get('/users/edit/{user}', 'editUser')->middleware(['auth', 'role:admin'])->name('users.edit');
    Route::post('/users', 'storeUser')->middleware(['auth', 'role:admin'])->name('users.store');
    Route::put('/users/{user}', 'updateUser')->middleware(['auth', 'role:admin'])->name('users.update');
    Route::get('/users/activate/{user}', 'activateUser')->middleware(['auth', 'role:admin'])->name('users.activate');
    Route::get('/users/deactivate/{user}', 'deactivateUser')->middleware(['auth', 'role:admin'])->name('users.deactivate');
});

Route::controller(DataTablesController::class)->group(function () {
    Route::get('/customers', 'customers')->middleware(['auth', 'role:admin'])->name('data-table.customers');
});

// Customer routes
Route::controller(CustomerController::class)->group(function () {
    Route::get('/pricing', 'pricing')->middleware(['auth', 'unsubscribed', 'preventDeactivated'])->name('pricing');
    Route::get('/payment-method', 'paymentMethod')
        ->middleware(['auth', 'unsubscribed', 'preventDeactivated'])->name('payment_method');
    Route::post('/subscribe', 'subscribe')->middleware(['auth', 'unsubscribed', 'preventDeactivated'])->name('subscribe');;
    Route::get('/subscribed', 'subscribed')->middleware(['auth', 'subscribed', 'preventDeactivated'])->name('subscribed');
});
