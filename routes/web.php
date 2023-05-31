<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UomController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RequestProductController;

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

    Route::group(['prefix' => 'sub-category' ],function (){
        Route::get('', [SubCategoryController::class, 'subCategory'])->name('sub.category');
        Route::get('/create', [SubCategoryController::class, 'subCategoryCreate'])->name('sub.category.create');
        Route::post('/create', [SubCategoryController::class, 'subCategoryStore'])->name('sub.category.store');
        Route::get('/edit/{id}', [SubCategoryController::class, 'subCategoryEdit'])->name('sub.category.edit');
        Route::post('/update', [SubCategoryController::class, 'subCategoryUpdate'])->name('sub.category.update');
        Route::get('/delete/{id}', [SubCategoryController::class, 'subCategoryDelete'])->name('sub.category.delete');
        Route::get('/active/{id}', [SubCategoryController::class, 'subCategoryActive'])->name('sub.category.status.active');
        Route::get('/inactive/{id}', [SubCategoryController::class, 'subCategoryInactive'])->name('sub.category.status.inactive');
    });




    Route::group(['prefix' => 'uom' ],function (){
        Route::get('', [UomController::class, 'uomIndex'])->name('uom');
        Route::get('/create', [UomController::class, 'uomCreate'])->name('uom.create');
        Route::post('/create', [UomController::class, 'uomStore'])->name('uom.store');
        Route::get('/edit/{id}', [UomController::class, 'uomEdit'])->name('uom.edit');
        Route::post('/update', [UomController::class, 'uomUpdate'])->name('uom.update');
        Route::get('/delete/{id}', [UomController::class, 'uomDelete'])->name('uom.delete');
        Route::get('/active/{id}', [UomController::class, 'uomActive'])->name('uom.status.active');
        Route::get('/inactive/{id}', [UomController::class, 'uomInactive'])->name('uom.status.inactive');
    });

    Route::group(['prefix' => 'product' ],function (){
        Route::get('', [ProductController::class, 'product'])->name('product');
        Route::get('/create', [ProductController::class, 'productCreate'])->name('product.create');
        Route::post('/create', [ProductController::class, 'productStore'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
        Route::post('/update', [ProductController::class, 'productUpdate'])->name('product.update');
        Route::get('/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
        Route::get('/active/{id}', [ProductController::class, 'productActive'])->name('product.status.active');
        Route::get('/inactive/{id}', [ProductController::class, 'productInactive'])->name('product.status.inactive');
    });

    Route::group(['prefix' => 'route' ],function (){
        Route::get('', [RouteController::class, 'route'])->name('route');
        Route::get('/create', [RouteController::class, 'routeCreate'])->name('route.create');
        Route::post('/create', [RouteController::class, 'routeStore'])->name('route.store');
        Route::get('/edit/{id}', [RouteController::class, 'routeEdit'])->name('route.edit');
        Route::post('/update', [RouteController::class, 'routeUpdate'])->name('route.update');
        Route::get('/delete/{id}', [RouteController::class, 'routeDelete'])->name('route.delete');
        Route::get('/active/{id}', [RouteController::class, 'routeActive'])->name('route.status.active');
        Route::get('/inactive/{id}', [RouteController::class, 'routeInactive'])->name('route.status.inactive');
    });

    Route::group(['prefix' => 'vendor' ],function (){
        Route::get('', [VendorController::class, 'vendor'])->name('vendor');
        Route::get('/create', [VendorController::class, 'vendorCreate'])->name('vendor.create');
        Route::post('/create', [VendorController::class, 'vendorStore'])->name('vendor.store');
        Route::get('/edit/{id}', [VendorController::class, 'vendorEdit'])->name('vendor.edit');
        Route::post('/update', [VendorController::class, 'vendorUpdate'])->name('vendor.update');
        Route::get('/delete/{id}', [VendorController::class, 'vendorDelete'])->name('vendor.delete');
        Route::get('/active/{id}', [VendorController::class, 'vendorActive'])->name('vendor.status.active');
        Route::get('/inactive/{id}', [VendorController::class, 'vendorInactive'])->name('vendor.status.inactive');
    });

    Route::group(['prefix' => 'request-product' ],function (){
        Route::get('', [RequestProductController::class, 'requestProduct'])->name('request.product');
        Route::get('/approved/product', [RequestProductController::class, 'requestProductApproved'])->name('request.product.approved');
        Route::get('/create', [RequestProductController::class, 'requestProductCreate'])->name('request.product.create');
        Route::post('/create', [RequestProductController::class, 'requestProductStore'])->name('request.product.store');
        Route::get('/active/{id}', [RequestProductController::class, 'requestProductActive'])->name('request.product.status.active');
        Route::get('/request/product/qty/check/{id}', [RequestProductController::class, 'requestProductQtyCheck'])->name('request.product.qty.check');
        Route::post('/product/preview/store', [RequestProductController::class, 'requestProductPreview'])->name('request.product.preview.store');
//        Route::get('/delete/{id}', [RequestProductController::class, 'requestProductDelete'])->name('request.product.delete');
//        Route::get('/inactive/{id}', [RequestProductController::class, 'requestProductInactive'])->name('request.product.status.inactive');
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
