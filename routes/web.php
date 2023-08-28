<?php

use App\Http\Controllers\CustomerController;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('customers', [CustomerController::class, 'index'])->name('customer.index');
Route::post('customers/login', [CustomerController::class, 'login'])->name('customer.login');
Route::get('customers/invalid', [CustomerController::class, 'invalid'])->name('customer.invalid');
Route::get('customers/confirmcode/{id}',[CustomerController::class, 'confirmcode'] )->name('customer.confirm');
Route::post('customers/validatecode', [CustomerController::class, 'validatecode'])->name('validatecode');

Route::get('customers/add', [CustomerController::class, 'addCustomer'])->name('customer.add');
Route::post('customesr/register/save', [CustomerController::class, 'register'])->name('customer.register');

Route::get('customers/invoices/{id}', [CustomerController::class, 'view_invoices'])->name('customer.invoices');
Route::post('customers/invoices/save',[CustomerController::class, 'store_invoice'])->name('customer.invoices.save');