<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesAttachmentsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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


require __DIR__ . '/auth.php';


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        //guest
        Route::middleware('guest')->group(function () {
            Route::get('/', function () {
                return view('auth.login');
            });
        });
        //auth
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::resource('invoices', InvoiceController::class);
        });

        Route::middleware('auth')->group(function () {
            Route::resource('products', ProductController::class);
        });

        Route::middleware('auth')->group(function () {
            Route::resource('sections', SectionsController::class);
        });

        //section select
        Route::get('/section/{id}', [InvoiceController::class, 'getproducts']);
        //invoice details
        Route::get('/invoice/details/{id}', [InvoicesDetailsController::class, 'show'])->name('invoice.details');
        // view invoice files
        Route::get('file/{invoice_num}/{file_name}', [InvoicesDetailsController::class, 'open_file'])->name('open_file');
        // download invoice files
        Route::get('download/{invoice_num}/{file_name}', [InvoicesDetailsController::class, 'download_file'])->name('download_file');
        // delete invoice files
        Route::delete('delete/file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');
        
        // Add another attachment file
        Route::post('attachment/add', [InvoicesAttachmentsController::class, 'store'])->name('another_attachment_store');

        //invoice Payment Status Show
        Route::get('/invoice/payment/status/{id}', [InvoiceController::class, 'show'])->name('invoicePaymentStatusShow');
        Route::post('/invoice/payment/status/update/{id}', [InvoiceController::class, 'statusUpdate'])->name('InvoicePaymentStatusUpdate');
        
        //index invoices paid
        Route::get('/invoice/paid', [InvoiceController::class, 'showPaidInvoices'])->name('invoices.paid');
        //index invoices unpaid
        Route::get('/invoice/unpaid', [InvoiceController::class, 'showUnpaidInvoices'])->name('invoices.unpaid');
        //index invoices partially-paid
        Route::get('/invoice/partially-paid', [InvoiceController::class, 'showPartiallyPaidInvoices'])->name('invoices.partially_paid');

        // archive invoice 
        Route::delete('invoice/archive', [InvoiceArchiveController::class, 'archive'])->name('invoice_archive');

        //archive
        Route::resource('archive', InvoiceArchiveController::class);

        //print
        Route::get('invoice/print/{id}',[InvoiceController::class, 'print_invoice'])->name('invoice_print');
        



        //Spatie
        Route::group(['middleware' => ['auth']], function() {
            Route::resource('roles', RoleController::class);
            Route::resource('users', UserController::class);
            });



        

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    }
);
