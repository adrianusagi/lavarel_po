<?php
use App\Http\Controllers\Dashboard;

Route::get('/', [Dashboard::class, 'index']);

/** ================================================= */
use App\Http\Controllers\Transaction\Purchase_request;

Route::get('/purchase_request', [Purchase_request::class, 'index']);
Route::get('/purchase_request/view', [Purchase_request::class, 'view']);
Route::get('/purchase_request/table', [Purchase_request::class, 'table']);
Route::get('/purchase_request/form', [Purchase_request::class, 'form']);
Route::post('/purchase_request', [Purchase_request::class, 'store']);
Route::post('/purchase_request/delete', [Purchase_request::class, 'delete']);

/** ================================================= */
use App\Http\Controllers\Transaction\Purchase_order;

Route::get('/purchase_order', [Purchase_order::class, 'index']);
Route::get('/purchase_order/view', [Purchase_order::class, 'view']);
Route::get('/purchase_order/table', [Purchase_order::class, 'table']);
Route::get('/purchase_order/form_select_pr', [Purchase_order::class, 'form_select_pr']);
Route::get('/purchase_order/form', [Purchase_order::class, 'form']);
Route::post('/purchase_order', [Purchase_order::class, 'store']);
Route::post('/purchase_order/delete', [Purchase_order::class, 'delete']);

/** ================================================= */
use App\Http\Controllers\Transaction\Receive_order;

Route::get('/receive_order', [Receive_order::class, 'index']);
Route::get('/receive_order/view', [Receive_order::class, 'view']);
Route::get('/receive_order/table', [Receive_order::class, 'table']);
Route::get('/receive_order/form_select_po', [Receive_order::class, 'form_select_po']);
Route::get('/receive_order/form', [Receive_order::class, 'form']);
Route::post('/receive_order', [Receive_order::class, 'store']);
Route::post('/receive_order/delete', [Receive_order::class, 'delete']);

/** ================================================= */
use App\Http\Controllers\Master\Cabang;

Route::get('/cabang', [Cabang::class, 'index']);
Route::get('/cabang/view', [Cabang::class, 'view']);
Route::get('/cabang/table', [Cabang::class, 'table']);
Route::get('/cabang/form', [Cabang::class, 'form']);
Route::post('/cabang', [Cabang::class, 'store']);
Route::post('/cabang/delete', [Cabang::class, 'delete']);

/** ================================================= */
use App\Http\Controllers\Master\Supplier;

Route::get('/supplier', [Supplier::class, 'index']);
Route::get('/supplier/view', [Supplier::class, 'view']);
Route::get('/supplier/table', [Supplier::class, 'table']);
Route::get('/supplier/form', [Supplier::class, 'form']);
Route::post('/supplier', [Supplier::class, 'store']);
Route::post('/supplier/delete', [Supplier::class, 'delete']);

/** ================================================= */
use App\Http\Controllers\Master\Product_catalog;

Route::get('/product_catalog', [Product_catalog::class, 'index']);
Route::get('/product_catalog/view', [Product_catalog::class, 'view']);
Route::get('/product_catalog/get', [Product_catalog::class, 'get']);
Route::get('/product_catalog/table', [Product_catalog::class, 'table']);
Route::get('/product_catalog/form', [Product_catalog::class, 'form']);
Route::post('/product_catalog', [Product_catalog::class, 'store']);
Route::post('/product_catalog/delete', [Product_catalog::class, 'delete']);