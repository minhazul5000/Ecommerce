<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\UserAuthControllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('user.userDashboard');
})->name('userDashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
//Guest
Route::middleware('guest:admin')->group(function (){
    Route::controller(AdminAuthController::class)->group(function (){
        Route::get('/admin/login', 'showLoginForm')->name('adminLogin');
        Route::post('/admin/login', 'loginProcess')->name('adminLogin');
    });
});

//Auth
Route::middleware('auth:admin')->group(function (){
    //Dashboard
    Route::get('/admin/dashboard',function (){
        return view('admin.adminDashboard');
    })->name('adminDashboard');

    //Logout
    Route::get('/admin/logout',[AdminAuthController::class,'logout'])->name('adminLogout');

    //Category
    Route::controller(CategoryController::class)->group(function (){
        Route::get('/admin/category','showCategory')->name('adminCategory');
    });

});


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
//Guest
Route::middleware('guest')->group(function (){
    Route::controller(UserAuthControllers::class)->group(function (){
        Route::get('/user/login', 'showLoginForm')->name('userLogin');
        Route::post('/user/login', 'loginProcess')->name('userLogin');

        Route::get('/user/register', 'showLoginForm')->name('userRegister');
    });

});

//Auth
Route::middleware('auth')->group(function (){
    Route::get('/user/logout', [UserAuthControllers::class,'logout'])->name('userLogout');
});
