<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionsController;

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


        

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    }
);
