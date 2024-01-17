<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminHomeController;
use App\Http\Controllers\Auth\AdminListController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\CustomerManagerController;
use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\BankController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\Auth\OrderController;
use App\Http\Controllers\Auth\OrderDetailController;

use App\Http\Controllers\UserController\HomeController;
use App\Http\Controllers\UserController\HomeDetailController;
use App\Http\Controllers\UserController\CustomerController;
use App\Http\Controllers\UserController\ClientLoginController;
use App\Http\Controllers\UserController\ClientLogoutController;
use App\Http\Controllers\UserController\ClientRegisterController;
use App\Http\Controllers\UserController\forgetPassController;
use App\Http\Controllers\UserController\ProductClientController;
use App\Http\Controllers\UserController\CartController;

use App\Http\Controllers\TestSubmit;


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

// Route::get('/', function () {
//     return view('front-end.welcome');
// });

// Route::get('/list', function () {
//     return view('list');
// });

Route::get('/', [
    HomeController::class, 'index'
    ])->name('client.home');

Route::prefix('account')->group(function() {
    Route::get('/login', [
        ClientLoginController::class, 'index'
    ])->name('client.login');
    Route::post('/login', [
        ClientLoginController::class, 'store'
    ])->name('client.login.store');
    Route::post('/logout', [
        ClientLogoutController::class, 'store'
    ])->name('client.logout');
    Route::get('/register', [
        ClientRegisterController::class, 'index'
    ])->name('client.register');
    Route::post('/register', [
        ClientRegisterController::class, 'store'
    ])->name('client.register.store');
});

//client
Route::prefix('account-manager')->group(function() {
    Route::get('/', [
        CustomerController::class, 'index'
    ])->name('account.index');
    Route::get('/edit', [
        CustomerController::class, 'edit'
    ])->name('account.info.edit');
    Route::post('/store', [
        CustomerController::class, 'update'
    ])->name('account.info.update');

        //forget pass
    Route::get('/forgetpassword', [
        ForgetPassController::class, 'forgetPass'
    ])->name('account.password.forget');
    Route::post('/forgetpassword', [
        ForgetPassController::class, 'forgetPassStore'
    ]);
    Route::get('/getpassword/{customer}/{token}', [
        ForgetPassController::class, 'getPass'
    ])->name('account.password.get');
    Route::post('/getpassword/{customer}/{token}', [
        ForgetPassController::class, 'getPassStore'
    ]);

        //change pass
    Route::get('/change-password', [
        forgetPassController::class, 'changePass'
    ])->name('account.password.edit');
    Route::post('/change-password', [
        forgetPassController::class, 'changePassStore'
    ])->name('account.password.update');

        //wishlist
    Route::get('/wishlist', [
        CartController::class, 'indexWishlist'
    ])->name('wishlist.index');
    Route::get('/wishlist/{rowId}', [
        CartController::class, 'removeItemWishlist'
    ])->name('wishlist.removeItem');
});

//product
Route::prefix('product')->group(function() {
    Route::get('/', [
        ProductClientController::class, 'index'
    ])->name('product.index');
    Route::get('/{id}', [
        ProductClientController::class, 'detail'
    ])->name('product.detail');
    Route::post('/store', [
        CartController::class, 'store'
    ])->name('cart.store');
    Route::get('/cart', [
        CartController::class, 'index'
    ])->name('cart.index');
    Route::post('/wishlist', [
        CartController::class, 'wishlist'
    ])->name('cart.wishlist');
});

Route::prefix('cart')->group(function() {
    // Route::post('/store', [
    //     CartController::class, 'store'
    // ])->name('cart.store');
    
    Route::get('/', [
        CartController::class, 'indexCart'
    ])->name('cart.index');
    Route::post('/quantity-changed/{rowId}', [
        CartController::class, 'updateItem'
    ])->name('cart.updateItem');
    Route::get('/delete-item/{rowId}', [
        CartController::class, 'removeItem'
    ])->name('cart.removeItem');
    Route::post('/checkout', [
        CartController::class, 'fakeCheckout'
    ])->name('cart.checkout');
});



//admin
Route::prefix('admin')->group(function () {
    //home
    Route::get('/home', [AdminHomeController::class, 'index'])->name('admin.home');
    Route::get('/', [AdminHomeController::class, 'index']);

    //auth
    //register
    Route::get('/register', [RegisterController::class, 'index'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'store']);

    //login
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'store']);

    //logout
    Route::post('/logout', [LogoutController::class, 'store'])->name('admin.logout');

    Route::prefix('management')->group(function() {
        //role
        Route::prefix('role')->group(function() {
            Route::get('/', [
                RoleController::class, 'index'
            ])->name('admin.role.index');
            Route::get('/{id_role}&{id_permission}', [
                RoleController::class, 'removePermission'
            ])->name('admin.role.removePermission');
            Route::post('/update/{id_role}', [
                RoleController::class, 'updateMultiplePermissions'
            ])->name('admin.role.updatePermissions');
            Route::get('/add', [
                RoleController::class, 'add'
            ])->name('admin.role.add');
            Route::post('store', [
                RoleController::class, 'store'
            ])->name('admin.role.store');
        });

        //permission
        Route::prefix('permission')->group(function() {
            Route::get('/', [
                PermissionController::class, 'index'
            ])->name('admin.permission.index');
            Route::get('/add', [
                PermissionController::class, 'add'
            ])->name('admin.permission.add');
            Route::post('/store', [
                PermissionController::class, 'store'
            ])->name('admin.permission.store');
        });

        Route::prefix('staff_management')->group(function (){
            Route::get('/', [
                AdminListController::class, 'index'
            ])->name('admin.adminList.index');
            Route::get('/add', [
                AdminListController::class, 'add'
            ])->name('admin.adminList.add');
            Route::post('/store', [
                AdminListController::class, 'store'
            ])->name('admin.adminList.store');
            Route::get('/edit/{id}', [
                AdminListController::class, 'edit'
            ])->name('admin.adminList.edit');
            Route::post('/update/{id}', [
                AdminListController::class, 'update'
            ])->name('admin.adminList.update');
            Route::get('/delete/{id}', [
                AdminListController::class, 'delete'
            ])->name('admin.adminList.delete');
        });
    });

    //bank
    Route::prefix('bank')->group(function () {
        Route::get('/', [
            BankController::class, 'index'
        ])->name('admin.bank.index');

        Route::get('/create', [
            BankController::class, 'create'
        ])->name('admin.bank.create');

        Route::post('/store', [
            BankController::class, 'store'
        ])->name('admin.bank.store');

        Route::get('/edit/{id}', [
            BankController::class, 'edit'
        ])->name('admin.bank.edit');

        Route::post('/update/{id}', [
            BankController::class, 'update'
        ])->name('admin.bank.update');

        Route::get('/delete/{id}', [
            BankController::class, 'delete'
        ])->name('admin.bank.delete');
    });


    //product
    Route::prefix('about')->group(function () {
        //product
        Route::prefix(('product'))->group(function () {
            Route::get('/', [
                ProductController::class, 'index'
            ])->name('admin.product.index');

            Route::get('/product_detail/{id}', [
                ProductController::class, 'detail'
            ])->name('admin.product.detail');

            Route::get('/create', [
                ProductController::class, 'create'
            ])->name('admin.product.create');

            Route::post('/store', [
                ProductController::class, 'store'
            ])->name('admin.product.store');

            Route::get('/edit/{id}', [
                ProductController::class, 'edit'
            ])->name('admin.product.edit');

            Route::post('/update/{id}', [
                ProductController::class, 'update'
            ])->name('admin.product.update');

            Route::get('/delete/{id}', [
                ProductController::class, 'delete'
            ])->name('admin.product.delete');
        });

        //order
        Route::prefix('order')->group(function () {
            Route::get('/', [
                OrderController::class, 'index'
            ])->name('admin.order.orderIndex');

            Route::get('/detail/{id}', [
                OrderController::class, 'detail'
            ])->name('admin.order.orderDetail');

            Route::post('/verify/{id}', [
                OrderController::class, 'verify'
            ])->name('admin.order.verify');

            Route::get('/create', [
                OrderDetailController::class, 'create'
            ])->name('admin.order.create');

            Route::post('/searchCustomer', [
                OrderDetailController::class, 'searchCustomer'
            ])->name('admin.order.searchCustomer');

            Route::post('/searchProduct', [
                OrderDetailController::class, 'searchProduct'
            ])->name('admin.order.searchProduct');

        });
    });


    //customer
    Route::prefix('customer_manager')->group(function () {
        Route::get('/', [
            CustomerManagerController::class, 'index'
        ])->name('admin.customer.index');

        Route::get('/detail/{id}', [
            CustomerManagerController::class, 'detail'
        ])->name('admin.customer.detail');

        Route::get('/edit/{id}', [
            CustomerManagerController::class, 'edit'
        ])->name('admin.customer.edit');

        Route::post('/update/{id}', [
            CustomerManagerController::class, 'update'
        ])->name('admin.customer.update');

        Route::get('/create', [
            CustomerManagerController::class, 'create'
        ])->name('admin.customer.create');

        Route::post('/store', [
            CustomerManagerController::class, 'store'
        ])->name('admin.customer.store');

        Route::post('/verify/{id}', [
            CustomerManagerController::class, 'verify'
        ])->name('admin.customer.verify');

        Route::get('/delete/{id}', [
            CustomerManagerController::class, 'delete'
        ])->name('admin.customer.delete');
    });
});

Route::get('/testSubmit', [
    TestSubmit::class, 'index'
])->name('test.index');

Route::get('/testSubmit/{id}', [
    TestSubmit::class, 'index'
])->name('test.get');
