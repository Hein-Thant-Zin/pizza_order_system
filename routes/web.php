<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\UserController as ControllersUserController;

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

// Route::redirect('/', 'homePage');
// Route::get('/', 'welcome');

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

            //profile
            Route::get('details', [AdminController::class, 'details'])->name('admin#details');
            Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');

            //admin list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');

            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');

            //ajax change role
            Route::get('ajax/change/role', [AdminController::class, 'ajaxChangeRole'])->name('ajax#changeRole');

            Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}', [AdminController::class, 'change'])->name('admin#change');
        });
        //products
        Route::prefix('products')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('products#list');
            Route::get('createPage', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('deatils/{id}', [ProductController::class, 'details'])->name('product#details');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
            Route::get('delete/{id}', [ProductController::class, 'deleteProduct'])->name('product#delete');
            Route::post('update', [ProductController::class, 'updateProduct'])->name('product#update');
        });


        //user List
        Route::prefix('user')->group(function () {
            Route::get('list', [ControllersUserController::class, 'userList'])->name('admin#userList');
            Route::get('ajax/change/role', [ControllersUserController::class, 'changeRole'])->name('admin#ajaxChangeRole');
        });


        //order
        Route::prefix('order')->group(function () {
            Route::get('list', [OrderController::class, 'orderList'])->name('admin#orderList');
            Route::post('change/status', [OrderController::class, 'changeStatus'])->name('admin#changeStatus');
            // Route::post('change/status', [OrderController::class, 'changeStatus'])->name('admin#changeStatus');
            // Route::get('ajax/status', [OrderController::class, 'ajaxStatus'])->name('admin#ajaxStatus');
            // Route::post('change/status', [OrderController::class, 'changeStatus'])->name('admin#changeStatus');

            Route::get('ajax/change/status', [OrderController::class, 'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('listInfo/{orderCode}', [OrderController::class, 'listInfo'])->name('order#listInfo');
        });
    });






    //user
    //home
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('homePage', [UserController::class, 'home'])->name('user#home');
        Route::get('/filter/{id}', [UserController::class, 'filter'])->name('user#filter');
        Route::get('history', [UserController::class, 'history'])->name('user#history');
        Route::prefix('cart')->group(function () {
            Route::get('/list', [UserController::class, 'cartList'])->name('cart#cartList');
        });

        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class, 'pizzaDetails'])->name('pizza#details');
        });

        Route::prefix('password')->group(function () {
            Route::get('change', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('changePassword', [UserController::class, 'changePassword'])->name('user#changePassword');
        });
        Route::prefix('account')->group(function () {
            Route::get('details', [UserController::class, 'details'])->name('user#details');
            Route::get('edit', [UserController::class, 'edit'])->name('user#edit');
            Route::post('update/{id}', [UserController::class, 'update'])->name('user#update');
        });

        Route::prefix('ajax')->group(function () {
            Route::get('pizza/list', [AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clearCart', [AjaxController::class, 'clearCart'])->name('ajax#clearCart');

            Route::get('clearCurrentProduct', [AjaxController::class, 'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
        });
        Route::get('api', [ApiController::class, 'api'])->name('api');
        // Route::get('apiTest', [ApiController::class, 'apiTest'])->name('api#test');
        Route::get('/route-cache', function () {
            Artisan::call('route:cache');
            return back();
        })->name('route#cacheClear');
    });
});





//user

Route::get('env', function () {
    return view('vendor.env-editor.index');
});



//home