<?php

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

Route::get('/', 'Site\MainController@homepage');
Route::get('/search/{query}', 'Site\MainController@searchResult');

Route::get('/about', function () { return view('site.about'); });
Route::get('/stores', function () { return view('site.stores'); });
Route::get('/contacts', function () { return view('site.stores'); });
Route::get('/our-brands', function () { return view('site.our-brands'); });
Route::get('/vacancies', function () { return view('site.vacancies'); });
Route::get('/delivery', function () { return view('site.services.delivery'); });
Route::get('/purchase-returns', function () { return view('site.services.purchase-returns'); });
Route::get('/pickup', function () { return view('site.services.pickup'); });
Route::get('/sales', function () { return view('site.sales'); });
Route::get('/slides/{id}', 'Site\MainController@detailSlide');

Route::get('/catalog/{slug}', 'Site\CatalogController@index');
Route::get('/catalog/product/{articul}', 'Site\CatalogController@product');
Route::post('/catalog/filter', 'Site\CatalogController@filter');
Route::post('/catalog/get_popular_products', 'Site\CatalogController@getPopularProductsByCategory');
Route::post('/catalog/get_new_products', 'Site\CatalogController@getNewProductsByCategory');
Route::post('/quickview', 'Site\CatalogController@quickView');

Route::get('/advices', 'Site\AdviceController@index');
Route::get('/advices/{slug}', 'Site\AdviceController@detail');
Route::get('/advices/type/{slug}', 'Site\AdviceController@adviceByType');

Route::post('/review/add', 'Site\ReviewController@addReview');

Route::post('/subscribe', 'Site\MainController@subscribe');
Route::post('/feedback', 'Site\MainController@feedback');

Route::get('/services', function () { return view('site.services.index'); });
Route::get('/services/{serviceID}', function () { return view('site.services.detail'); });

Route::get('/sign-up', 'Site\AccountController@signUpPage');
Route::post('/sign-up', 'Site\AccountController@signUp');
Route::get('/sign-in', 'Site\AccountController@signInPage');
Route::post('/sign-in', 'Site\AccountController@signIn');
Route::get('/logout', 'Site\AuthController@logout');

Route::get('/account', 'Site\AccountController@dashboard');
Route::get('/account/profile', 'Site\AccountController@profile');
Route::post('/account/profile/edit', 'Site\AccountController@profileUpdate');
Route::get('/account/orders', 'Site\AccountController@myOrders');
Route::get('/account/orders/{id}', 'Site\AccountController@viewMyOrder');
Route::get('/account/password', 'Site\AccountController@password');
Route::post('/account/password/change', 'Site\AccountController@passwordChange');

Route::get('/cart', 'Site\CartController@viewCart');
Route::post('/add-to-cart', 'Site\CartController@addToCart');
Route::get('/get-cart-items', 'Site\CartController@getCartItems');
Route::get('/get-cart-total-price', 'Site\CartController@getCartTotalPrice');
Route::post('/remove-from-cart', 'Site\CartController@removeFromCart');
Route::post('/remove-from-cart-page', 'Site\CartController@removeFromCartPage');
Route::post('/cart-change-qnt', 'Site\CartController@changeQuantityCart');
Route::get('/cart-empty', function () { return view('site.cart-empty'); });
Route::get('/compare', function () { return view('site.compare'); });
Route::get('/checkout', 'Site\CartController@checkout');
Route::post('/checkout/order', 'Site\CartController@checkoutOrder');
Route::get('/wishlist', 'Site\CartController@wishlist');
Route::post('/add-to-wishlist', 'Site\CartController@addToWishlist');
Route::post('/get-wishlist-qnt', 'Site\CartController@qntWishlist');
Route::post('/remove-from-wishlist', 'Site\CartController@removeFromWishlist');

Route::get('/faq', function () {  });
Route::get('/terms-and-conditions', function () { return view('site.terms'); });
Route::get('/rules', function () {  });

// admin
Route::get('/admin','Site\AuthController@index');
Route::get('/admin/login','Site\AuthController@login');
Route::post('/admin/login','Admin\UsersController@signIn');

Route::group(['middleware'=> ['admin']], function () {

    // filemanager
    Route::get('/admin/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/admin/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');

    // categories
    Route::get('/admin/categories','Admin\CategoryController@index');
    Route::get('/admin/categories/{id}','Admin\CategoryController@getCategory');
    Route::post('/admin/categories/add','Admin\CategoryController@addCategoryForm');
    Route::post('/admin/categories/store','Admin\CategoryController@storeCategory');
    Route::post('/admin/categories/edit','Admin\CategoryController@editCategory');
    Route::post('/admin/categories/update','Admin\CategoryController@updateCategory');

    // attributes
    Route::get('/admin/categories/{id}/props','Admin\AttributeController@getProps');
    Route::post('/admin/props/add','Admin\AttributeController@addPropertyForm');
    Route::post('/admin/props/store','Admin\AttributeController@addProperty');
    Route::post('/admin/props/edit','Admin\AttributeController@editPropertyForm');
    Route::post('/admin/props/update','Admin\AttributeController@updateProperty');
    Route::post('/admin/props/values','Admin\AttributeController@propertyValues');
    Route::post('/admin/props/values/save','Admin\AttributeController@propertyValuesSave');
    Route::post('/admin/props/delete','Admin\AttributeController@deleteProperty');

    // products
    Route::get('/admin/products/add/{cat_id}','Admin\ProductController@add');
    Route::get('/admin/products/show/{id}','Admin\ProductController@show');
    Route::get('/admin/products/edit/{id}','Admin\ProductController@edit');
    Route::post('/admin/products/edit/{id}','Admin\ProductController@update');
    Route::get('/admin/products/deleteimg/{id}', 'Admin\ProductController@deleteimg');
    Route::post('/admin/products/gallery', 'Admin\ProductController@uploadImageGallery');
    Route::post('/admin/products/gallery/remove', 'Admin\ProductController@removeImageGallery');

    // brands
    Route::get('/admin/brands','Admin\BrandController@index');
    Route::post('/admin/brands/add','Admin\BrandController@addBrandForm');
    Route::post('/admin/brands/store','Admin\BrandController@storeBrand');
    Route::post('/admin/brands/edit','Admin\BrandController@editBrand');
    Route::post('/admin/brands/update','Admin\BrandController@updateBrand');

    // logout
    Route::get('/admin/logout','Admin\UsersController@logout');

    // profile
    Route::get('/admin/users/profile','Admin\UsersController@profile');

    // users
    Route::get('/admin/users','Admin\UsersController@index');
    Route::get('/admin/users/show/{id}','Admin\UsersController@show');
    Route::get('/admin/users/create','Admin\UsersController@create');
    Route::post('/admin/users/store','Admin\UsersController@store');
    Route::get('/admin/users/edit/{id}','Admin\UsersController@edit');
    Route::post('/admin/users/edit/{id}','Admin\UsersController@update');
    Route::get('/admin/users/delete/{id}', 'Admin\UsersController@delete');
    Route::post('/admin/users/remove_image', 'Admin\UsersController@removeImage');

    // advices
    Route::get('/admin/advices', 'Admin\AdviceController@index');
    Route::get('/admin/advices/show/{id}', 'Admin\AdviceController@show');
    Route::get('/admin/advices/create', 'Admin\AdviceController@create');
    Route::post('/admin/advices/create', 'Admin\AdviceController@store');
    Route::get('/admin/advices/edit/{id}', 'Admin\AdviceController@edit');
    Route::post('/admin/advices/edit/{id}', 'Admin\AdviceController@update');
    Route::get('/admin/advices/delete/{id}', 'Admin\AdviceController@destroy');
    Route::get('/admin/advices/deleteimg/{id}', 'Admin\AdviceController@deleteimg');

    // slideshow
    Route::get('/admin/slideshow', 'Admin\SlideshowController@index');
    Route::get('/admin/slideshow/show/{id}', 'Admin\SlideshowController@show');
    Route::get('/admin/slideshow/create', 'Admin\SlideshowController@create');
    Route::post('/admin/slideshow/create', 'Admin\SlideshowController@store');
    Route::get('/admin/slideshow/edit/{id}', 'Admin\SlideshowController@edit');
    Route::post('/admin/slideshow/edit/{id}', 'Admin\SlideshowController@update');
    Route::get('/admin/slideshow/delete/{id}', 'Admin\SlideshowController@destroy');
    Route::get('/admin/slideshow/deleteimg/{id}/{type}', 'Admin\SlideshowController@deleteimg');

    // config
    Route::get('/admin/config', 'Admin\ConfigurationController@index');
    Route::post('/admin/config', 'Admin\ConfigurationController@save');

    // reviews
    Route::get('/admin/reviews', 'Admin\ReviewsController@index');
    Route::get('/admin/reviews/show/{id}', 'Admin\ReviewsController@show');
    Route::get('/admin/reviews/delete/{id}', 'Admin\ReviewsController@destroy');

    // orders
    Route::get('/admin/orders', 'Admin\OrdersController@index');
    Route::get('/admin/orders/show/{id}', 'Admin\OrdersController@show');
    Route::post('/admin/orders/show/{id}', 'Admin\OrdersController@update');

});
