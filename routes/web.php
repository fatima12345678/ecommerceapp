<?php



Route::get('/', function () {return view('pages.index');});
//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
        // Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');



///Admin secation
/// category

Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category', 'Admin\Category\CategoryController@storecategory')->name('store.category');
Route::get('delete/category/{id}', 'Admin\Category\CategoryController@deletecategory');
Route::get('edit/category/{id}', 'Admin\Category\CategoryController@editcategory');
Route::post('update/category/{id}', 'Admin\Category\CategoryController@updatecategory');


/// Brand
Route::get('admin/brands', 'Admin\Category\BrandController@brand')->name('brands');
Route::post('admin/store/brand', 'Admin\Category\BrandController@storebrand')->name('store.brand');
Route::get('delete/brand/{id}', 'Admin\Category\BrandController@deletebrand');
Route::get('edit/brand/{id}', 'Admin\Category\BrandController@editbrand');
Route::post('update/brand/{id}', 'Admin\Category\BrandController@updatebrand');


///sub category
Route::get('admin/subcategories', 'Admin\Category\SubCategoryController@subcategory')->name('subcategories');
Route::post('admin/store/subcategory', 'Admin\Category\SubCategoryController@storesubcategory')->name('store.subcategory');
Route::get('delete/subcategory/{id}', 'Admin\Category\SubCategoryController@deletesubcategory');
Route::get('edit/subcategory/{id}', 'Admin\Category\SubCategoryController@editsubcategory');
Route::post('update/subcategory/{id}', 'Admin\Category\SubCategoryController@updatesubcategory');



///All Coupons////
Route::get('admin/coupons', 'Admin\Category\CouponController@coupon')->name('coupons');
Route::post('admin/store/coupon', 'Admin\Category\CouponController@storecoupon')->name('store.coupon');
Route::get('delete/coupon/{id}', 'Admin\Category\CouponController@deletecoupon');
Route::get('edit/coupon/{id}', 'Admin\Category\CouponController@editcoupon');
Route::post('update/coupon/{id}', 'Admin\Category\CouponController@updatesubcoupon');

//Newslater
Route::get('admin/newslater', 'Admin\Category\CouponController@newslater')->name('newslaters');
Route::get('delete/newslate/{id}', 'Admin\Category\CouponController@deletenewslater');

// for show sub category with ajax
Route::get('get/subcategory/{category_id}', 'Admin\ProductController@getsubcat');

//All Product//
Route::get('admin/product/all', 'Admin\ProductController@index')->name('all.product');
Route::get('admin/product/add', 'Admin\ProductController@create')->name('add.product');
Route::post('admin/store/product', 'Admin\ProductController@storeproduct')->name('store.product');
Route::get('active/product/{id}', 'Admin\ProductController@active');
Route::get('inactive/product/{id}', 'Admin\ProductController@inactive');
Route::get('delete/product/{id}', 'Admin\ProductController@delete');
Route::get('view/product/{id}', 'Admin\ProductController@view');
Route::get('edit/product/{id}', 'Admin\ProductController@edit');
Route::post('update/product/withoutimage/{id}', 'Admin\ProductController@withoutimage');
Route::post('update/product/image/{id}', 'Admin\ProductController@image');




//All Blog
Route::get('blog/category/list', 'Admin\PostController@blog')->name('add.blog.categorylist');
Route::post('admin/store/blog', 'Admin\PostController@storeblogcategory')->name('store.blogcategory');
Route::get('delete/blog/{id}', 'Admin\PostController@delete');
Route::get('edit/blog/{id}', 'Admin\PostController@edit');
Route::post('update/blog/{id}', 'Admin\PostController@update');
Route::get('admin/add/post', 'Admin\PostController@create')->name('add.blogpost');
Route::get('admin/all/post', 'Admin\PostController@index')->name('all.blogpost');
Route::post('store/post', 'Admin\PostController@store')->name('store.post');
Route::get('delete/post/{id}', 'Admin\PostController@deletepost');
Route::get('edit/post/{id}', 'Admin\PostController@editpost');
Route::post('update/post/{id}', 'Admin\PostController@updatepost');

///All Frontend
Route::post('store/newslater', 'FrontController@newslater')->name('store.newslater');
Route::get('add/wishlist/{id}', 'WishlistController@addwishlist');
Route::get('product/details/{id}/{product_name}', 'ProductController@productview');
//All Cart
Route::get('add/cart/{id}', 'CartController@addcart');
Route::get('check', 'CartController@check');
Route::post('cart/product/add/{id}', 'CartController@Add');
Route::get('cart/show', 'CartController@Show')->name('show.cart');
Route::get('remove/cart/{rowId}', 'CartController@remove');
Route::post('update/cart/{rowId}', 'CartController@update');
Route::get('/cart/product/view/{id}', 'CartController@viewproduct');
Route::post('update/cart/{rowId}', 'CartController@update');
Route::post('insert/cart', 'CartController@insert')->name('insert.into.cart');
Route::get('checkout/user', 'CartController@checkout')->name('user.checkout');
Route::get('wishlist/user', 'CartController@wishlist')->name('wishlist.user');
Route::post('apply/coupon', 'CartController@coupon');
Route::get('coupon/remove', 'CartController@couponremove');
Route::get('payment/user', 'CartController@payment');

//payment
Route::post('payment/product', 'PaymentController@payment');

///blog
Route::get('blog/post', 'BlogController@blog');
Route::get('english/lang', 'BlogController@english');
Route::get('arbic/lang', 'BlogController@arbic');
Route::get('blog/single/{id}', 'BlogController@blogsingle');


///shop
Route::get('shop/products/{id}', 'ProductController@shopview');
Route::get('category/view/{id}', 'ProductController@categoryview');

