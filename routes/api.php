<?php

use App\Http\Controllers\danhmucdulieu\LoaiSPController;
use App\Http\Controllers\sanpham\SanphamController;
use App\Models\loaisp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\taikhoan\TaiKhoanNVController;
use App\Http\Controllers\taikhoan\TaiKhoanKHController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('danhmucsp/{id}/loaisp', [LoaiSPController::class, 'getByDanhMucSP']);
Route::get('loaisp/{id}/sanpham', [SanphamController::class, 'getByLoaisp']);

Route::get('taikhoankh/sua', [TaiKhoanKHController::class, 'khoatk']);
Route::get('taikhoannv/sua', [TaiKhoanNVController::class, 'khoatk']);