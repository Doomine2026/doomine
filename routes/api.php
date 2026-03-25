<?php

use App\Http\Controllers\PaymentWebhookController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getTest', [PaymentWebhookController::class, 'testIzipayWebhook']);

Route::post('/v1/payments/webhook/izipay', [PaymentWebhookController::class, 'handleIzipayNotification']);

Route::post('/products/paginate', [ProductsController::class, 'paginate'])->name('products.paginate');
