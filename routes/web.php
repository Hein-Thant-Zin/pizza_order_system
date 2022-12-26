<?php

use App\Http\Controllers\AdminController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

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


Route::middleware(['admin_auth'])->group(function () {
    //login //register
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});


//after authentication
Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    //admin
    // Route::group(['middleware' => 'auth_admin'], function () {
    // }); dr lel ya

    Route::middleware(['admin_auth'])->group(function () {
        //category
        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
            // Route::get('passwordChange', [CategoryController::class, 'changePassword'])->name('changePasswordPage');
        });

        //admin account
        //same Route::group(['prefix'=>'admin'],function(){
        // })
        //passsword
        Route::prefix('admin')->group(function () {
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');
        });
        //profile
        Route::get('details', [AdminController::class, 'details'])->name('admin#details');
        Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
        Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');
    });




    //user
    //home
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('home', function () {
            return view('user.home');
        })->name('user#home');
    });
});






//user

//home