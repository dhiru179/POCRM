<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimnController;
use App\Http\Controllers\PoController;
use App\Http\Controllers\admin\FetchApiController;
use App\Http\Controllers\InvoiceOwnController;
use App\Http\Controllers\InvoicePrincipleController;
use App\Http\Controllers\InvoiceController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::group(['middleware'=>'guest'],function(){

//     // Route::get('admin/registration', [DashBoardController::class, 'Registration'])->name('admin.registration');
//     Route::get('/', [DashBoardController::class, 'Login'])->name('admin.login');
// });
Route::get('/', [SimnController::class, 'Login']);
Route::post('/loginauth', [SimnController::class, 'LoginAuth'])->name('loginAuth');
Route::group(['middleware' => 'Admin_auth'], function () {

    Route::get('logout', function () {

        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->forget('ADMIN_USER');

        return redirect('/');
    });
    Route::get('/admin', [SimnController::class, 'dashBoard']);
    Route::get('admin/customer_{url}', [SimnController::class, 'actionOnCustomer']);
    Route::post('admin/add_coustomer/save', [SimnController::class, 'coustomerSave'])->name('saveCoustomer');
    Route::get('admin/seller_{url}', [SimnController::class, 'actionOnSeller']);
    Route::post('admin/add_seller/save', [SimnController::class, 'sellerSave'])->name('saveSeller');

    Route::get('admin/po_{url}', [PoController::class, 'poDetails']);
    Route::post('admin/po_details/save', [PoController::class, 'poDetailsSave'])->name('savePoDetails');
    Route::get('admin/po_details/{url}', [PoController::class, 'actionOnPo']);


    Route::get('admin/invoice_{url}', [InvoiceController::class, 'actionOnInvoice']);
    Route::post('admin/preview_invoice/save', [InvoiceController::class, 'previewInvoice'])->name('previewInvoice');

    Route::get('admin/invoicePrinciple_{param}', [InvoicePrincipleController::class, 'invoicePrinciple']);
    Route::post('admin/invoice_principle/save', [InvoicePrincipleController::class, 'invoicePrincipleSave'])->name('saveInvoicePrinciple');
    


    Route::get('admin/invoiceOwn_{param}', [InvoiceOwnController::class, 'invoiceOwn']);
    Route::post('admin/invoice_own/save', [InvoiceOwnController::class, 'invoiceOwnSave'])->name('saveInvoiceOwn');
   


});
