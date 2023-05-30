<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UomController;

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
    return view('welcome');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class,'loginDashboard'])->name('login.post');

Route::group(['prefix' => 'admin','middleware' => ['auth','prevent-back-history'],'as' =>'backend.'],function() {
    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('lock', [AuthController::class, 'lock'])->name('lock');
    Route::post('lock', [AuthController::class, 'unlock'])->name('unlock');


    Route::group(['prefix' => 'category' ],function (){
        Route::get('', [CategoryController::class, 'category'])->name('category');
        Route::get('/create', [CategoryController::class, 'categoryCreate'])->name('category.create');
        Route::post('/create', [CategoryController::class, 'categoryStore'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
        Route::post('/update', [CategoryController::class, 'categoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');
        Route::get('/active/{id}', [CategoryController::class, 'categoryActive'])->name('category.status.active');
        Route::get('/inactive/{id}', [CategoryController::class, 'categoryInactive'])->name('category.status.inactive');
    });
    Route::group(['prefix' => 'uom' ],function (){
        Route::get('', [UomController::class, 'uomIndex'])->name('uom');
        Route::get('/create', [UomController::class, 'uomCreate'])->name('uom.create');
        Route::post('/create', [UomController::class, 'uomStore'])->name('uom.store');
        Route::get('/edit/{id}', [UomController::class, 'uomEdit'])->name('uom.edit');
        Route::post('/update', [UomController::class, 'uomUpdate'])->name('oum.update');
        Route::get('/delete/{id}', [UomController::class, 'uomDelete'])->name('uom.delete');
        Route::get('/active/{id}', [UomController::class, 'uomActive'])->name('uom.status.active');
        Route::get('/inactive/{id}', [UomController::class, 'uomInactive'])->name('uom.status.inactive');
    });

    Route::group(['prefix' => 'product' ],function (){
        Route::get('', [ProductController::class, 'product'])->name('product');
    });

    Route::group(['prefix' => 'user' ],function (){
        Route::get('', [UserController::class, 'user'])->name('user');
    });
});
