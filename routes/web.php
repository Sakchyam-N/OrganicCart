<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\TraderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FrontProdController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaypalController;

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
Route::get('/', [CustomersController::class,'index'])->name('cust.index');

Route::get('/about',[CustomerController::class,'about'])->name('about');
Route::get('/ques',[CustomerController::class,'ques'])->name('ques');
Route::get('/contact',[CustomerController::class,'contact'])->name('contact');
Route::get('/terms',[CustomerController::class,'terms'])->name('terms');
Route::get('/howtosell',[CustomerController::class,'howtosell'])->name('howtosell');
Route::get('/privacy',[CustomerController::class,'privacy'])->name('privacy');
Route::post('/order',[PaypalController::class,'order'])->name('order.store');
Route::get('/paid/{id}',[PaypalController::class,'paid'])->name('paid');
Route::get('/myorder',[CustomerController::class,'myorder'])->name('cust.order');
Route::get('/traderprofile',[TraderController::class,'traderprofile'])->name('traderprofile');
Route::get('/traderchangepw',[TraderController::class,'traderchangepw'])->name('traderchangepw');
Route::get('/ordertrader',[TraderController::class,'ordertrader'])->name('ordertrader');
Route::post('/traderupdate' ,[TraderController::class,'update'])->name('trader.update');


Route::get('/signup',[CustomerController::class,'signup'])->name('cust.signup');

Route::get('frontProduct/productDetail/{frontProduct}',[FrontProdController::class,'prodDetail'])->name('frontProduct.prodDetail');
Route::post('frontProduct/search' ,[FrontProdController::class,'search'])->name('frontProduct.search');
Route::get('frontProduct/allcat/{frontProduct}',[FrontProdController::class,'sortCategory'])->name('frontProduct.catSort');
Route::get('frontProduct/categoryProd/{frontProduct}/{sort}',[FrontProdController::class,'sortProduct'])->name('frontProduct.prodSort');
Route::resource('frontProduct',FrontProdController::class);
Route::get('/verification/{customer}',[CustomersController::class,'email_verification']);
Route::resource('customers',CustomersController::class);
Route::resource('reviews',ReviewController::class);
Route::get('/prodsrating',function(){
    return view('prodsratings');
});
Route::get('/collection',function(){
    return view('collection');
});

Route::get('/pay',function(){
    return view('pay');
})->name('pay');
/*Route::get('/paypal',function(){
    return view('paypal');
});*/
Route::get('/success',function(){
    return view('success');
});

Route::post('/paypal',[PaymentController::class,'payWithpaypal'])->name('paypal.pay');
Route::get('/status',[PaymentController::class,'getPaymentStatus'])->name('status');


Route::get('/traderregister',[CustomerController::class,'traderSignup'])->name('trader.signup'); 
Route::post('/traderStore',[TraderController::class,'store'])->name('trader.storeId');

Route::get('/logoutuser',[UserController::class,'logoutuser']);



Route::group(['middleware'=>"protected"],function(){
    Route::resource('wishlists',WishlistController::class);
    Route::resource('carts',CartController::class);
    Route::get('products/viewProd',[ProductController::class,'viewprods'])->name('products.viewprods');
    Route::get('products/viewProd/{product}',[ProductController::class,'sortA'])->name('products.sort');
    Route::get('products/shopCreate',[ProductController::class,'shopCreate'])->name('products.shopAdd');
    Route::post('products/shopCreate',[ProductController::class,'shopStore'])->name('products.shopstore');
    Route::get('products/offer/{product}',[ProductController::class,'createOffer'])->name('products.offer');
    Route::post('products/offer',[ProductController::class,'offerStore'])->name('products.offerStore');
    Route::get('products/offerview',[ProductController::class,'viewoffer'])->name('products.offerview');
    Route::resource('products',ProductController::class);
    Route::get('/userlogin',[CustomerController::class,'userLogin'])->name('user.login');
    Route::post('/userlogin',[UserController::class,'loginuser']);  
    
    
});

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

