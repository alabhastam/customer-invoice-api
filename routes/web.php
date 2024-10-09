<?php
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('v1')->group(function () {
    // Customer routes
    Route::apiResource('customers', CustomerController::class);
    
    // Invoice routes
    Route::apiResource('invoices', InvoiceController::class);
});
