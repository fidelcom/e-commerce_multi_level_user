<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Analyst\AnalystController;
use App\Http\Controllers\Analyst\AnalystProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Subadmin\SubAdminController;
use App\Http\Controllers\Subadmin\SubAdminProfileController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendorProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
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
Route::get('/vendor/login', [VendorController::class, 'login'])->name('vendor.login');
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
Route::get('/sub-admin/login', [SubAdminController::class, 'login'])->name('subadmin.login');
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
Route::get('/analyst/login', [AnalystController::class, 'login'])->name('analyst.login');
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
