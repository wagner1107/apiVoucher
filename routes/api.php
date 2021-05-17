<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\OfertaController;
use App\Http\Controllers\Api\VoucherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// --------------------------------------------------------------------------


Route::namespace('Clientes')->group( function(){
    Route::get('/healthCheckCliente', [ClienteController::class, 'status']);
    Route::post('/cliente/add', [ClienteController::class, 'add']);
    Route::get('/cliente', [ClienteController::class, 'list']);
    Route::get('/cliente/{id}', [ClienteController::class, 'select']);
    Route::put('/cliente/{id}', [ClienteController::class, 'update']);
});

Route::namespace('Oferta')->group( function(){
    Route::get('/healthCheckOferta', [OfertaController::class, 'status']);
    Route::post('/oferta/add', [OfertaController::class, 'add']);
    Route::get('/oferta', [OfertaController::class, 'list']);
    Route::get('/oferta/{id}', [OfertaController::class, 'select']);
    Route::put('/oferta/{id}', [OfertaController::class, 'update']);
    Route::delete('/oferta/{id}', [OfertaController::class, 'delete']);
});


Route::namespace('Voucher')->group( function(){
    Route::get('/healthCheckVoucher', [VoucherController::class, 'status']);
    Route::post('/voucher/add', [VoucherController::class, 'add']);
    Route::get('/voucher', [VoucherController::class, 'list']);
    Route::get('/voucher/email', [VoucherController::class, 'listVoucherWithEmail']);
    Route::get('/validar', [VoucherController::class, 'select']);
    Route::put('/voucher/{id}', [VoucherController::class, 'update']);
    Route::delete('/voucher/{id}', [VoucherController::class, 'delete']);
});
