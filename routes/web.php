<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Analyst\AnalystController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Subadmin\SubAdminController;
use App\Http\Controllers\Vendor\VendorController;
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
Route::middleware('auth', 'role:vendor')->prefix('/vendor')->group(function () {
    Route::get('/dashboard', [VendorController::class, 'index']);
});

//Sub-admin
Route::middleware('auth', 'role:subadmin')->prefix('/sub-admin')->group(function () {
    Route::get('/dashboard', [SubAdminController::class, 'index']);
});

// Analyst
Route::middleware('auth', 'role:analyst')->prefix('/analyst')->group(function () {
    Route::get('/dashboard', [AnalystController::class, 'index']);
});

require __DIR__.'/auth.php';
