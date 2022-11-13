<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;
use App\Models\Category;

Route::middleware('admin_auth')->group(function(){
    // login , register

    Route::redirect('/' , 'loginPage' );
    Route::get('loginPage' , [AuthController::class , 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage' , [AuthController::class , 'registerPage'])->name('auth#registerPage');
});




Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('dashboard',[AuthController::class , 'dashboard'])->name('dashboard');

    Route::middleware('admin_auth')->group(function(){
         // category
         Route::prefix('category')->group(function(){
            Route::get('list' , [CategoryController::class , 'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');

        });

        // admin account info
        Route::prefix('admin')->group(function(){
            // admin
            Route::get('change/password',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            // admin info
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            // admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('role/{id}',[AdminController::class,'role'])->name('admin#role');
            Route::post('roleUpdate/{id}',[AdminController::class,'roleUpdate'])->name('admin#roleUpdate');


        });

        //pizza products info
        Route::prefix('product')->group(function(){
            //product list
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });
    });



    //user

    // user home page
    Route::group(['prefix' => 'user' , 'middleware' => 'user_auth'],function(){
            // user Home Page
          Route::prefix('/')->group(function(){
                Route::get('/homePage',[UserController::class,'home'])->name('user#home');
                Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
          });


            Route::prefix('pizza')->group(function(){
                Route::get('details/{id}',[UserController::class,'detailsPage'])->name('user#detailsPage');
                // Route::get('test',[UserController::class,'test'])->name('user#test');
            });


            // user password change
            Route::prefix('account')->group(function(){
                Route::get('passwordChangePage',[UserController::class,'passwordChangePage'])->name('user#passwordChangePage');
                Route::post('passwordChange',[UserController::class,'passwordChange'])->name('user#passwordChange');
            });

            // user account update
            Route::prefix('profile')->group(function(){
                Route::get('updatePage',[UserController::class,'updatePage'])->name('user#updatePage');
                Route::post('update/{id}',[UserController::class,'update'])->name('user#update');
            });

          Route::prefix('ajax')->group(function(){
               Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            });

    });
});
