<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\VillageController;

Route::get('province', [ProvinceController::class, 'all'])->name('province.all');
Route::get('regency/{province_id}',  [RegencyController::class, 'all'])->name('regency.all');
Route::get('district/{city_id}', [DistrictController::class, 'all'])->name('district.all');
Route::get('village/{district_id}', [VillageController::class, 'all'])->name('village.all');

Route::get('price/{product_id}', 'ApiController@getProductPrice');
Route::get('product/{pemasok_id}', 'ApiController@getProduct');
Route::get('buyer', 'ApiController@getBuyer');

