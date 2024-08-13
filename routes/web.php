<?php

use App\Http\Controllers\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\WishlistController;

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

// Route nhóm cho phần frontend bán hàng với prefix 'shop'
Route::prefix('shop')->group(function () {
    // Trang chủ
    Route::redirect('/', '/shop/home');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Account
    Route::get('/account', [CustomerController::class, 'info'])->middleware('cus')->name('infoUser');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('cus')->name('wishlist.index');

    // Checkout
    // Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('cus')->name('checkout.index');
    Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('cus')->name('checkout.view');
    Route::post('/checkout/place', [CheckoutController::class, 'placeOrder'])->middleware('cus')->name('checkout.place');


    // Order
    Route::get('orders', [CustomerOrderController::class, 'index'])->name('customer.orders.index');
    Route::get('orders/{id}', [CustomerOrderController::class, 'show'])->name('customer.orders.show');
    
    // Cart
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // About
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about_us');

    // Contact
    Route::get('/contact', [HomeController::class, 'contact'])->name('contactHome');

    // Product
    Route::get('/products', [HomeProductController::class, 'index'])->name('productList');

    Route::get('/products/{product_id}', [HomeProductController::class, 'productDetail'])->name('productDetail');

    // Auth
    Route::get('/login', [CustomerController::class, 'showLoginForm'])->name('customer.login');

    Route::post('/login', [CustomerController::class, 'login'])->name('userLogin');

    Route::post('/logout', [CustomerController::class, 'logoutCustomer'])->name('logoutCustomer');

    Route::get('/register', [CustomerController::class, 'showRegisterForm'])->name('customer.register');

    Route::post('/register', [CustomerController::class, 'register'])->name('userRegister');

    // Blog
    // Route::get('/blog', [BlogController::class, 'blog']);
    
});

Route::get('/home', function () {
    return view('welcome');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


// Route nhóm cho phẩn admin 
Route::prefix('admin')->group(function () {
    Route::redirect('/', '/admin/login');

    Route::get('/home', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/contact', function () {
        return view('admin.contact');
    })->name('contact');

    Route::get('/login', [AdminController::class, 'loginAdmin'])->name('loginAdmin');

    Route::post('/post', [AdminController::class, 'postLoginAdmin'])->name('postLoginAdmin');

    Route::post('/logout', [AdminController::class, 'logoutAdmin'])->name('logoutAdmin');

    // Category
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware' => 'can:category-list'
        ]);

        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware' => 'can:category-add'
        ]);

        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);
    });

    // Menus
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
            'middleware' => 'can:menu-list'
        ]);

        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create',
            'middleware' => 'can:menu-add'
        ]);

        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'App\Http\Controllers\MenuController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit',
            'middleware' => 'can:menu-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete',
            'middleware' => 'can:menu-delete'
        ]);
    });

    // Product
    Route::prefix('product')->group(function () {
        Route::get('/', [
            'as' => 'product.index',
            'uses' => 'App\Http\Controllers\ProductController@index',
            'middleware' => 'can:product-list'
        ]);

        Route::get('/create', [
            'as' => 'product.create',
            'uses' => 'App\Http\Controllers\ProductController@create',
            'middleware' => 'can:product-add'
        ]);

        Route::post('/store', [
            'as' => 'product.store',
            'uses' => 'App\Http\Controllers\ProductController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'product.edit',
            'uses' => 'App\Http\Controllers\ProductController@edit',
            'middleware' => 'can:product-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'product.update',
            'uses' => 'App\Http\Controllers\ProductController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'product.delete',
            'uses' => 'App\Http\Controllers\ProductController@delete',
            'middleware' => 'can:product-delete'
        ]);
    });

    // Slider
    Route::prefix('slider')->group(function () {
        Route::get('/', [
            'as' => 'slider.index',
            'uses' => 'App\Http\Controllers\SliderController@index',
            'middleware' => 'can:slider-list'
        ]);

        Route::get('/create', [
            'as' => 'slider.create',
            'uses' => 'App\Http\Controllers\SliderController@create',
            'middleware' => 'can:slider-add'
        ]);

        Route::post('/store', [
            'as' => 'slider.store',
            'uses' => 'App\Http\Controllers\SliderController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'slider.edit',
            'uses' => 'App\Http\Controllers\SliderController@edit',
            'middleware' => 'can:slider-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'slider.update',
            'uses' => 'App\Http\Controllers\SliderController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'slider.delete',
            'uses' => 'App\Http\Controllers\SliderController@delete',
            'middleware' => 'can:slider-delete'
        ]);
    });

    // Setting
    Route::prefix('setting')->group(function () {
        Route::get('/', [
            'as' => 'setting.index',
            'uses' => 'App\Http\Controllers\SettingController@index',
            'middleware' => 'can:setting-list'
        ]);

        Route::get('/create', [
            'as' => 'setting.create',
            'uses' => 'App\Http\Controllers\SettingController@create',
            'middleware' => 'can:setting-add'
        ]);

        Route::post('/store', [
            'as' => 'setting.store',
            'uses' => 'App\Http\Controllers\SettingController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'setting.edit',
            'uses' => 'App\Http\Controllers\SettingController@edit',
            'middleware' => 'can:setting-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'setting.update',
            'uses' => 'App\Http\Controllers\SettingController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'setting.delete',
            'uses' => 'App\Http\Controllers\SettingController@delete',
            'middleware' => 'can:setting-delete'
        ]);
    });

    // User
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'App\Http\Controllers\UserController@index',
            'middleware' => 'can:user-list'
        ]);

        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'App\Http\Controllers\UserController@create',
            'middleware' => 'can:user-add'
        ]);

        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'App\Http\Controllers\UserController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'App\Http\Controllers\UserController@edit',
            'middleware' => 'can:user-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'App\Http\Controllers\UserController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'App\Http\Controllers\UserController@delete',
            'middleware' => 'can:user-delete'
        ]);
    });

    // Role
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'App\Http\Controllers\RoleController@index',
            'middleware' => 'can:role-list'
        ]);

        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'App\Http\Controllers\RoleController@create',
            'middleware' => 'can:role-add'
        ]);

        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'App\Http\Controllers\RoleController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'App\Http\Controllers\RoleController@edit',
            'middleware' => 'can:role-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'App\Http\Controllers\RoleController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'roles.delete',
            'uses' => 'App\Http\Controllers\RoleController@delete',
            'middleware' => 'can:role-delete'
        ]);
    });

    // Customer
    Route::prefix('customers')->group(function () {
        Route::get('/', [
            'as' => 'customers.index',
            'uses' => 'App\Http\Controllers\AdminCustomerController@index',
            // 'middleware' => 'can:customer-list'
        ]);
    });

    // Order
    // Route::prefix('orders')->group(function () {
    //     Route::get('/', [
    //         'as' => 'orders.index',
    //         'uses' => 'App\Http\Controllers\OrderController@index',
    //     ]);
    // });
    Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('orders/{id}/confirm', [AdminOrderController::class, 'confirm'])->name('admin.orders.confirm');
    Route::get('orders/{id}/cancel', [AdminOrderController::class, 'cancel'])->name('admin.orders.cancel');
});
