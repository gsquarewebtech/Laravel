<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\WebsiteFeedsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;


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

// Example Routes
Route::view('/', 'landing');
Route::view('/pages/blank', 'pages.blank');

Auth::routes(['verify' => true]);
Route::middleware(['auth', 'verified', 'locale'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

Route::group(['namespace' => 'User','prefix' => 'users', 'as' => 'users.'], function()
{
    
});

Route::middleware(['checkrole', 'locale'])->group(function(){
    Route::resource('user', UserController::class);
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::delete('user/delete', [UserController::class, 'destroy'])->name('delete-user');


Route::resource('roles', UserRoleController::class);
    Route::get('roles', [UserRoleController::class, 'index'])->name('roles');
    Route::delete('roles/delete', [UserRoleController::class, 'destroy'])->name('delete-role');
});


Route::get('/', [LocalizationController::class, "index"]);
Route::get('change/lang', [LocalizationController::class, "lang_change"])->name('LangChange');




