<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Analyst\AnalystController;
use App\Http\Controllers\Analyst\AnalystProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductMultiImageController;
use App\Http\Controllers\Backend\ProductStatuController;
use App\Http\Controllers\Backend\ProductSubcategoryController;
use App\Http\Controllers\Backend\VendorManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Subadmin\SubAdminController;
use App\Http\Controllers\Subadmin\SubAdminProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

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
//    return view('welcome');
    return view('frontend.index');
});

//user
Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::post('/user/profile/update', [UserController::class, 'update'])->name('user.profile.update');
    Route::post('/user/change/password', [UserController::class, 'password'])->name('user.change.password');
    Route::get('/user/logout', [UserController::class, 'destroy'])->name('user.logout');
});
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::middleware('auth', 'role:admin')->prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');

    //Profile
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile');
    Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/profile/change/password', [AdminProfileController::class, 'show'])->name('admin.change.password');
    Route::post('/profile/change/password/store', [AdminProfileController::class, 'store'])->name('admin.change.password.store');
});

//Vendor
Route::get('/vendor/login', [VendorController::class, 'login'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'createVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'register'])->name('vendor.register');
Route::middleware('auth', 'role:vendor')->prefix('/vendor')->group(function () {
    Route::get('/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');

    Route::get('/logout', [VendorController::class, 'destroy'])->name('vendor.logout');

    //Profile
    Route::get('/profile/edit', [VendorProfileController::class, 'edit'])->name('vendor.profile');
    Route::post('/profile/update', [VendorProfileController::class, 'update'])->name('vendor.profile.update');
    Route::get('/profile/change/password', [VendorProfileController::class, 'show'])->name('vendor.change.password');
    Route::post('/profile/change/password/store', [VendorProfileController::class, 'store'])->name('vendor.change.password.store');
});

//Sub-admin
Route::get('/sub-admin/login', [SubAdminController::class, 'login'])->name('subadmin.login')->middleware(RedirectIfAuthenticated::class);
Route::middleware('auth', 'role:subadmin')->prefix('/sub-admin')->group(function () {
    Route::get('/dashboard', [SubAdminController::class, 'index'])->name('subadmin.dashboard');

    Route::get('/logout', [SubAdminController::class, 'destroy'])->name('subadmin.logout');

    //Profile
    Route::get('/profile/edit', [SubAdminProfileController::class, 'edit'])->name('subadmin.profile');
    Route::post('/profile/update', [SubAdminProfileController::class, 'update'])->name('subadmin.profile.update');
    Route::get('/profile/change/password', [SubAdminProfileController::class, 'show'])->name('subadmin.change.password');
    Route::post('/profile/change/password/store', [SubAdminProfileController::class, 'store'])->name('subadmin.change.password.store');
});

// Analyst
Route::get('/analyst/login', [AnalystController::class, 'login'])->name('analyst.login')->middleware(RedirectIfAuthenticated::class);
Route::middleware('auth', 'role:analyst')->prefix('/analyst')->group(function () {
    Route::get('/dashboard', [AnalystController::class, 'index'])->name('analyst.dashboard');

    Route::get('/logout', [AnalystController::class, 'destroy'])->name('analyst.logout');

    //Profile
    Route::get('/profile/edit', [AnalystProfileController::class, 'edit'])->name('analyst.profile');
    Route::post('/profile/update', [AnalystProfileController::class, 'update'])->name('analyst.profile.update');
    Route::get('/profile/change/password', [AnalystProfileController::class, 'show'])->name('analyst.change.password');
    Route::post('/profile/change/password/store', [AnalystProfileController::class, 'store'])->name('analyst.change.password.store');
});

require __DIR__.'/auth.php';

//Brand
Route::middleware('auth', 'role:admin,subadmin')->prefix('/brand')->controller(BrandController::class)->group(function (){
    Route::get('/all', 'index')->name('all.brand');
    Route::get('/add', 'create')->name('add.brand');
    Route::post('/store', 'store')->name('store.brand');
    Route::get('/edit/{id}', 'edit')->name('edit.brand');
    Route::post('/update/{id}', 'update')->name('update.brand');
    Route::get('/delete/{id}', 'destroy')->name('delete.brand');
});

//Product Category
Route::middleware('auth', 'role:admin,subadmin')->prefix('/product/category')->controller(ProductCategoryController::class)->group(function (){
    Route::get('/all', 'index')->name('all.product.category');
    Route::get('/add', 'create')->name('add.product.category');
    Route::post('/store', 'store')->name('store.product.category');
    Route::get('/edit/{id}', 'edit')->name('edit.product.category');
    Route::post('/update/{id}', 'update')->name('update.product.category');
    Route::get('/delete/{id}', 'destroy')->name('delete.product.category');
});

//Product Subcategory
Route::middleware('auth', 'role:admin,subadmin')->prefix('/product/subcategory')
    ->controller(ProductSubcategoryController::class)->group(function (){
    Route::get('/all', 'index')->name('all.product.subcategory');
    Route::get('/add', 'create')->name('add.product.subcategory');
    Route::get('/show/{id}', 'show')->name('show.product.subcategory');
    Route::post('/store', 'store')->name('store.product.subcategory');
    Route::get('/edit/{id}', 'edit')->name('edit.product.subcategory');
    Route::post('/update/{id}', 'update')->name('update.product.subcategory');
    Route::get('/delete/{id}', 'destroy')->name('delete.product.subcategory');
});

//Vendor management
Route::middleware('auth', 'role:admin,subadmin')->prefix('/vendor/management')->controller(VendorManagementController::class)->group(function (){
    Route::get('/active', 'active')->name('active.vendor');
    Route::get('/inactive', 'inactive')->name('inactive.vendor');
    Route::get('/view/vendor/{id}', 'show')->name('view.vendor');
    Route::post('/change/status/{id}', 'updateStatus')->name('change.status');
});

//Product management
Route::middleware('auth', 'role:admin,subadmin')->prefix('/product')
    ->controller(ProductController::class)->group(function (){
    Route::get('/all', 'index')->name('all.product');
    Route::get('/add', 'create')->name('add.product');
    Route::post('/store', 'store')->name('store.product');
    Route::get('/edit/{id}', 'edit')->name('edit.product');
    Route::post('/update/{id}', 'update')->name('update.product');
    Route::post('/update/thumbnail/{id}', 'updateThumbnail')->name('update.product.thumbnail');
    Route::get('/delete/{id}', 'destroy')->name('delete.product');
});
//Product management multiple image
Route::middleware('auth', 'role:admin,subadmin')->prefix('/product')
    ->controller(ProductMultiImageController::class)->group(function (){
        Route::post('/update/multi/image/{id}', 'update')->name('update.product.multi.image');
        Route::post('/add/multi/image/{id}', 'store')->name('add.product.multi.image');
        Route::get('/delete/multi/image{id}', 'destroy')->name('delete.product.multi.image');
    });

//Product status update
Route::middleware('auth', 'role:admin,subadmin')->prefix('/product')
    ->controller(ProductStatuController::class)->group(function (){
        Route::get('/update/status/{id}', 'status')->name('product.change.status');
    });
