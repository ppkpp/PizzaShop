<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//login , register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerpage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

//dashboard
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

Route::group(['middleware'=>'admin_auth'],function(){
    //admin ->category

    // Route::prefix('category')->group(function () {
    //     Route::get('/list',[CategoryController::class,'list'])->name('category#list');
    // })->middleware('admin_auth');

    Route::group(['prefix'=>'category'],function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('ceate/page',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'deleteCategory'])->name('delete#category');
        Route::get('edit/{id}',[CategoryController::class,'editCategory'])->name('edit#category');
        Route::post('update',[CategoryController::class,'updateCategory'])->name('update#category');
    });

    //admin section
    Route::group(['prefix'=>'admin'],function(){

        //password
        Route::get('password/change',[AdminController::class,'adminPasswordChange'])->name('admin#passwordChange');
        Route::post('submit/password',[AdminController::class,'adminPasswordSubmit'])->name('admin#passwordSubmit');
        Route::get('cancel/change',[AdminController::class,'cancelPasswordChange'])->name('admin#cancelChange');
        // Route::get('confirm',[AuthController::class,'confirmToChange'])->name('admin#confirmToChange');

        //profile
        Route::get('details',[AdminController::class,'adminDetails'])->name('admin#Details');
        Route::get('edit/profile',[AdminController::class,'editAdminProfile'])->name('edit#adminProfile');
        Route::post('update/profile/{id}',[AdminController::class,'updateAdminProfile'])->name('update#adminProfile');

        //role change
        Route::get('adminlist',[AdminController::class,'adminList'])->name('admin#list');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
        Route::get('change/role/{id}',[AdminController::class,'changeRole'])->name('change#role');
        Route::post('submit/role{id}',[AdminController::class,'submitRole'])->name('submit#role');

        //order list
        Route::get('order/list',[OrderController::class,'orderList'])->name('order#list#admin');
        Route::post('change/order/list',[OrderController::class,'changeOrderList'])->name('change#order#list');
        Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('ajax#changeStatus');
        Route::get('order/info/{orderCode}',[OrderController::class,'orderInfo'])->name('order#info');
        // Route::get('order/details/info',[OrderController::class,'orderDetailsInfo'])->name('order#detailsInfo');

        //pending
        Route::get('pending/info',[AdminController::class,'pending'])->name('view#pending');
        Route::get('pending/list',[AdminController::class,'pendingList'])->name('pending#list');
    });

    //product menu (food and drinks)
    Route::group(['prefix'=>'product'],function(){
        Route::get('list',[ProductController::class,'list'])->name('product#list');
        Route::get('create',[ProductController::class,'productCreate'])->name('product#create');
        Route::post('create',[ProductController::class,'addingProduct'])->name('add#product');
        Route::get('delete/{id}',[ProductController::class,'deleteProduct'])->name('delete#product');
        Route::get('view/{id}',[ProductController::class,'viewProduct'])->name('view#Products');
        Route::get('edit/{id}',[ProductController::class,'editProduct'])->name('edit#Product');
        Route::post('edit/submit/{id}',[ProductController::class,'submitProduct'])->name('submit#Product');
    });

    //change user to admin
    Route::group(['prefix'=>'admin'],function(){
        Route::get('user/list',[UserController::class,'userList'])->name('user#list');
        Route::get('user/change/role',[UserController::class,'userChangeRole'])->name('user#changeRole');
    });

    //suggestions by users
    Route::get('suggestion',[RatingController::class,'userSuggestion'])->name('user#suggestion');

});

    // user
    // Route::prefix('user')->group(function () {
    //     Route::get('/home',function(){
    //         return view ('user.home');
    //     })->name('user#home');
    // })->middleware('user_auth');
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        Route::get('home',[UserController::class,'userHome'])->name('user#home');
        Route::get('profile/{id}',[UserController::class,'lookProfile'])->name('look#profile');
        Route::get('editprofile/{id}',[Usercontroller::class,'editProfile'])->name('edit#Profile');
        Route::post('submit/newProfile/{id}',[UserController::class,'submitProfile'])->name('update#userProfile');
        Route::get('history',[UserController::class,'orderHistory'])->name('order#History');
        Route::get('order/info/{orderCode}',[OrderController::class,'orderInfoUser'])->name('order#info#user');
        // Route::get('category/to/show',[UserController::class,'categoryToShow'])->name('category#toShow');

        //change password for users
        Route::get('change/password',[UserController::class,'changeUserPassword'])->name('change#UserPassword');
        Route::post('submit/password',[UserController::class,'submitUserPassword'])->name('submit#UserPassword');

        //ajax
        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('pizza#List');
            Route::get('list/cart',[AjaxController::class,'cartList'])->name('cart#list');
            Route::get('checkout',[AjaxController::class,'checkout'])->name('check#out');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('clear#cart');
            Route::get('clear/each/product',[AjaxController::class,'clearEachProduct'])->name('clear#eachProduct');
            Route::get('increase/view/count',[AjaxController::class,'increaseViewCount'])->name('increase#viewCount');
            Route::get('add/to/fav',[AjaxController::class,'addToFav'])->name('addto#Favorite');
            Route::get('view/fav',[AjaxController::class,'viewFavPage'])->name('view#FavPage');
            Route::get('clear/fav',[AjaxController::class,'clearFav'])->name('clear#Fav');
        });

        //contact page
        Route::prefix('contact')->group(function(){
            Route::get('page',[RatingController::class,'contactPage'])->name('contact#page');
            Route::post('submit',[RatingController::class,'submitDescription'])->name('submit#description');
        });

        //wishlist
        Route::prefix('favorite')->group(function(){
            Route::get('add/{id}',[FavoriteController::class,'addToFavorite'])->name('addTo#favorite');
            Route::get('page',[FavoriteController::class,'wishlistPage'])->name('wishlist#page');
        });


        Route::get('filter/{id}',[UserController::class,'pizzaFilter'])->name('user#filter');

        Route::get('product/detail/{id}',[UserController::class,'productDetail'])->name('product#detail');

        Route::get('cart/page',[UserController::class,'cartListPage'])->name('cart#list#page');

        // Route::get('detail/from/fav/{id}',[UserController::class,'detailFromFav'])->name('detail#fromFav');
    });


