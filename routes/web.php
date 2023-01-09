<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\GenderController;
use App\Http\Controllers\Backend\ProvinceController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\MunicipalityController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\OrderStatusController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [HomeController::class, 'handleAdmin'])->name('admin.route')->middleware('admin');
Route::prefix('backend/')->name('backend.')->group(function(){
    Route::get('/backend/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});
Route::prefix('backend/')->name('backend.')->group(function(){
    //category
    Route::post('category/getSubcategoryByCategoryId',[CategoryController::class,'getSubcategoryByCategoryId'])->name('category.getSubcategory');
    Route::get('category/trash', [CategoryController::class,'trash'])->name('category.trash');
    Route::post('category/{id}/restore', [CategoryController::class,'restore'])->name('category.restore');
    Route::delete('category/{id}/force-delete',[CategoryController::class,'forceDelete'])->name('category.forceDelete');
    Route::resource('category',CategoryController::class);
    //profile
    Route::resource('profile',ProfileController::class);
    //gender
    Route::resource('gender',GenderController::class);

    Route::get('province/trash', [ProvinceController::class,'trash'])->name('province.trash');
    Route::post('province/{id}/restore', [ProvinceController::class,'restore'])->name('province.restore');
    Route::delete('province/{id}/force-delete',[ProvinceController::class,'forceDelete'])->name('province.forceDelete');
    //for ajax to get district by province id
    Route::post('province/getDistrictByProvinceId',[ProvinceController::class,'getDistrictByProvinceId'])->name('province.getDistrict');
    Route::resource('province',ProvinceController::class);

    Route::get('district/trash', [DistrictController::class,'trash'])->name('district.trash');
    Route::post('district/{id}/restore', [DistrictController::class,'restore'])->name('district.restore');
    Route::delete('district/{id}/force-delete',[DistrictController::class,'forceDelete'])->name('district.forceDelete');
    Route::resource('district',DistrictController::class);

    Route::get('order/trash', [OrderController::class,'trash'])->name('order.trash');
    Route::post('order/{id}/restore', [OrderController::class,'restore'])->name('order.restore');
    Route::delete('order/{id}/force-delete',[OrderController::class,'forceDelete'])->name('order.forceDelete');
    Route::resource('order',OrderController::class);

    Route::get('municipality/trash', [MunicipalityController::class,'trash'])->name('municipality.trash');
    Route::post('municipality/{id}/restore', [MunicipalityController::class,'restore'])->name('municipality.restore');
    Route::delete('municipality/{id}/force-delete',[MunicipalityController::class,'forceDelete'])->name('municipality.forceDelete');
    Route::resource('municipality',MunicipalityController::class);

    Route::get('unit/trash', [UnitController::class, 'trash'])->name('unit.trash');
    Route::post('unit/{id}/restore', [UnitController::class, 'restore'])->name('unit.restore');
    Route::delete('unit/{id}/force-delete', [UnitController::class, 'forceDelete'])->name('unit.forceDelete');
    Route::resource('unit',UnitController::class);

    Route::get('orderStatus/trash', [OrderStatusController::class, 'trash'])->name('orderStatus.trash');
    Route::post('orderStatus/{id}/restore', [OrderStatusController::class, 'restore'])->name('orderStatus.restore');
    Route::delete('orderStatus/{id}/force-delete', [OrderStatusController::class, 'forceDelete'])->name('orderStatus.forceDelete');
    Route::resource('orderStatus',OrderStatusController::class);

    Route::get('payment/trash', [PaymentController::class, 'trash'])->name('payment.trash');
    Route::post('payment/{id}/restore', [PaymentController::class, 'restore'])->name('payment.restore');
    Route::delete('payment/{id}/force-delete', [PaymentController::class, 'forceDelete'])->name('payment.forceDelete');
    Route::resource('payment',PaymentController::class);

    Route::post('product/getAllAttribute',[ProductController::class,'getAllAttribute'])->name('product.getAllAttribute');
    Route::post('product/changeStatusById',[ProductController::class,'changeStatusById'])->name('product.changeStatus');

    Route::get('product/trash', [ProductController::class,'trash'])->name('product.trash');
    Route::post('product/{id}/restore', [ProductController::class,'restore'])->name('product.restore');
    Route::delete('product/{id}/force-delete',[ProductController::class,'forceDelete'])->name('product.forceDelete');
    Route::resource('product',ProductController::class);
    Route::get('product/active/{id}', [ProductController::class,'active'])->name('product.active');
    Route::get('product/deactivate/{id}', [ProductController::class,'deactive'])->name('product.deactive');
    Route::get('product/recommendedon/{id}', [ProductController::class,'recommendedon'])->name('product.recommendedon');
    Route::get('product/recommendedoff/{id}', [ProductController::class,'recommendedoff'])->name('product.recommendedoff');
    Route::get('product/flashon/{id}', [ProductController::class,'flashon'])->name('product.flashon');
    Route::get('product/flashoff/{id}', [ProductController::class,'flashoff'])->name('product.flashoff');

    Route::get('attribute/trash', [AttributeController::class,'trash'])->name('attribute.trash');
    Route::post('attribute/{id}/restore', [AttributeController::class,'restore'])->name('attribute.restore');
    Route::delete('attribute/{id}/force-delete',[AttributeController::class,'forceDelete'])->name('attribute.forceDelete');
    Route::resource('attribute',AttributeController::class);

    Route::get('subcategory/trash', [SubcategoryController::class,'trash'])->name('subcategory.trash');
    Route::post('subcategory/{id}/restore', [SubcategoryController::class,'restore'])->name('subcategory.restore');
    Route::delete('subcategory/{id}/force-delete',[SubcategoryController::class,'forceDelete'])->name('subcategory.forceDelete');
    Route::resource('subcategory',SubcategoryController::class);


});
Route::group(['middleware' => 'auth'], function() {
    Route::get('/changePassword',[App\Http\Controllers\HomeController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',[App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('changePasswordPost');
});
Route::post('/mregister', [APIController::class, 'register']);

