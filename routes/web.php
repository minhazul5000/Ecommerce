<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserAuthControllers;
use Illuminate\Support\Facades\Route;



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
        //Show
        Route::get('/admin/category','showCategory')->name('showCategory');

        //Add
        Route::get('/admin/category/add','addCategory')->name('addCategory');
        Route::post('/admin/category/add','addCategory')->name('addCategory');

        //Update
        Route::get('/admin/category/update/{id}','updateCategory')->name('updateCategory');
        Route::post('/admin/category/update/{id}','updateCategory')->name('updateCategory');

        //Delete
        Route::get('/admin/category/delete/{id}','deleteCategory')->name('deleteCategory');
    });

    //Subcategory
    Route::controller(SubCategoryController::class)->group(function (){
        //Show
        Route::get('/admin/sub-category','showSubCategory')->name('showSubCategory');

        //Add
        Route::get('/admin/sub-category/add','addSubCategory')->name('addSubCategory');
        Route::post('/admin/sub-category/add','addSubCategory')->name('addSubCategory');

        //Update
        Route::get('/admin/sub-category/update/{id}','updateSubCategory')->name('updateSubCategory');
        Route::post('/admin/sub-category/update/{id}','updateSubCategory')->name('updateSubCategory');

        //Delete
        Route::get('/admin/sub-category/delete/{id}','deleteSubCategory')->name('deleteSubCategory');
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
    Route::controller(UserAuthControllers::class)->group(function (){
        Route::get('/user/profile','showProfile')->name('userProfile');
        Route::get('/user/logout', 'logout')->name('userLogout');
    });

});


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class,'frontendDashboard'])->name('frontendDashboard');

Route::get('/{cat?}/{subcat?}', [HomeController::class,'viewCategoryProduct']);

Route::get('/new',function (){
    return "hello";
});
