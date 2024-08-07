<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\{
    CalendarController,
    ProfileController,
    MailSettingController,
    SellerController
};
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MailController;

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
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/test-mail', function () {

    $message = "Testing mail";

    Mail::raw('Hi, welcome!', function ($message) {
        $message->to('ajayydavex@gmail.com')
            ->subject('Testing mail');
    });

    dd('sent');
});

Route::get("/send-mail",[MailController::class, 'index'] );

// Route::get('/dashboard', function () {
//     return view('front.dashboard');
// })->middleware(['front'])->name('dashboard');


require __DIR__ . '/front_auth.php';

// Admin routes
// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('admin.dashboard');

require __DIR__ . '/auth.php';

Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function () {
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');
        Route::resource('categorys', 'CategoryController');
        Route::resource('products', 'ProductController');
        Route::resource('seller', 'SellerController');
        Route::resource("dashboard", 'DashboardController');
        Route::resource("stockType", 'StockTypeController');
        Route::resource("durationtype", 'LimitDurationTypeController');
        Route::resource("limitDuration", "LimitDurationController");
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/mail', [MailSettingController::class, 'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}', [MailSettingController::class, 'update'])->name('mail.update');
    });

Route::namespace('App\Http\Controllers\Front')->name('front.')->prefix('front')
    ->group(function () {
        Route::resource('frontuser', 'FrontuserController');
    });


