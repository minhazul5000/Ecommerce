<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserAuthControllers;
use Illuminate\Support\Facades\Route;

Route::fallback(function (){
   abort(404);
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
//Guest

Route::prefix('admin')->controller(AdminAuthController::class)->middleware('guest:admin')->group(function (){
    Route::get('/login', 'showLoginForm')->name('adminLogin');
    Route::post('/login', 'loginProcess')->name('adminLogin');
});

//Auth
Route::prefix('admin')->middleware('auth:admin')->group(function (){
    //Dashboard
    Route::get('/dashboard',function (){
        return view('admin.adminDashboard');
    })->name('adminDashboard');

    //Logout
    Route::get('/logout',[AdminAuthController::class,'logout'])->name('adminLogout');

    //Category CRUD
    Route::resource('categories',CategoryController::class)->except(['show']);

    //Subcategory CRUD
    Route::resource('sub-categories',SubCategoryController::class)->except(['show']);

    //Brand CRUD
    Route::resource('brands',BrandController::class)->except('show');

    //Product CRUD
    Route::resource('products',ProductController::class)->except('show');
});


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
//Guest
Route::prefix('user')->controller(UserAuthControllers::class)->middleware('guest')->group(function (){
    Route::get('/login', 'showLoginForm')->name('userLogin');
    Route::post('/login', 'loginProcess')->name('userLogin');

    Route::get('/register', 'showLoginForm')->name('userRegister');
});

//Auth
Route::prefix('user')->controller(UserAuthControllers::class)->middleware('auth')->group(function (){
    Route::get('/profile','showProfile')->name('userProfile');
    Route::get('/logout', 'logout')->name('userLogout');
});


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/products/{slug?}',[HomeController::class,'productDetails'])->name('products.details');
Route::get('/', [HomeController::class,'frontendDashboard'])->name('frontendDashboard');

Route::get('/{cat?}/{subcat?}', [HomeController::class,'viewCategoryProduct']);


