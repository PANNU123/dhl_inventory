<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolePermissionController;

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

    Route::group(['prefix' => 'product' ],function (){
        Route::get('', [ProductController::class, 'product'])->name('product');
    });

    Route::group(['prefix' => 'user' ],function (){
        Route::get('', [UserController::class, 'user'])->name('user');
    });

     //Role Settings
     Route::get('/roles', [RolePermissionController::class, 'index'])->name('role.list');
     Route::get('/create-role', [RolePermissionController::class, 'createRole'])->name('create.role');
     Route::post('/store-role', [RolePermissionController::class, 'storeRole'])->name('store.role');
     Route::get('/edit-role/{id}', [RolePermissionController::class, 'editRole'])->name('edit.role');
     Route::post('/update-role/{id}', [RolePermissionController::class, 'updateRole'])->name('update.role');
     Route::get('/delete-role/{id}', [RolePermissionController::class, 'deleteRole'])->name('delete.role');

     Route::get('/list', [AdminRoleController::class, 'adminList'])->name('user.list');
     Route::get('/create', [AdminRoleController::class, 'createAdmin'])->name('create.admin');
     Route::post('/store', [AdminRoleController::class, 'storeAdmin'])->name('store.admin');
     Route::get('/edit/{id}', [AdminRoleController::class, 'editAdmin'])->name('edit.admin');
     Route::post('/update', [AdminRoleController::class, 'updateAdmin'])->name('update.admin');
     Route::get('/delete/{id}', [AdminRoleController::class, 'deleteAdmin'])->name('delete.admin');
});