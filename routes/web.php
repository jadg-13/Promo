<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CodePromoController;
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
    return view('customers.login');
});

Route::get('customers', [CustomerController::class, 'index'])->name('customer.index');
Route::post('customers/login', [CustomerController::class, 'login'])->name('customer.login');
Route::get('customers/confirmcode/{id}',[CustomerController::class, 'confirmcode'] )->name('customer.confirm');
Route::post('customers/validatecode', [CustomerController::class, 'validatecode'])->name('validatecode');
Route::get('customers/invalid', [CustomerController::class, 'invalid'])->name('customer.invalid');
Route::get('customers/close', [CustomerController::class, 'logout'])->name('customer.logout');


Route::get('customers/add', [CustomerController::class, 'addCustomer'])->name('customer.add');
Route::post('customesr/register/save', [CustomerController::class, 'register'])->name('customer.register');

Route::get('customers/invoices/{id}', [CustomerController::class, 'view_invoices'])->name('customer.invoices');
Route::post('customers/invoices/save',[CustomerController::class, 'store_invoice'])->name('customer.invoices.save');


Route::get('admin/customers', [AdminController::class, 'showCustomers'])->name('admin.customers');
Route::get('admin/customers/find', [AdminController::class, 'showCustomersBy'])->name('customer.findby');
Route::get('admin/customers/download', [AdminController::class, 'export'])->name('export'); 

Route::get('admint/user/add', [AdminController::class, 'add'])->name('admin.user.add');
Route::post('admin/user/add/save', [AdminController::class, 'store'])->name('admin.users.store');
Route::get('admin/user/list', [AdminController::class, 'showUsers'])->name('admin.user.show');
Route::get('admin/user/download', [AdminController::class, 'showUsersExport'])->name('exportuser'); 
//Route::get('admin/code/import', [AdminController::class, 'importExcel'])->name('importcode'); 
//Route::post('admin/code/import/xls', [ExportController::class, 'importXls'])->name('importxls'); 

Route::get('admin/codes/index', [CodePromoController::class, 'index'])->name('admin.codes.index');
Route::get('admin/codes/add', [CodePromoController::class, 'add'])->name('admin.codes.add');
Route::post('admin/codes/add/store', [CodePromoController::class, 'store'])->name('admin.codes.store');
Route::delete('admin/codes/del/{id}',  [CodePromoController::class, 'delete'])->name('admin.codes.delete');
Route::get('admin/codes/findby', [CodePromoController::class, 'findby'])->name('admin.codes.findby'); 