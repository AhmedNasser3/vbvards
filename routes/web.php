<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AllUserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ActiveUserController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Middleware\ConvertNumbersToArabic;
use App\Http\Controllers\ShippingAreaController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\SubSubCategoryController;
use App\Http\Controllers\Admin\AdminHomeController;

Route::middleware([ConvertNumbersToArabic::class])->group(function () {
    // هنا يتم تطبيق الـ middleware على جميع الـ routes التي يتم تعريفها داخل هذا الـ group
    Route::get('/', [HomeController::class, 'index'])->name('home.page');
});
Route::controller(OrderController::class)->group(function(){
    Route::get('/pending/order' , 'PendingOrder')->name('pending.order');
    Route::get('/admin/order/details/{order_id}' , 'AdminOrderDetails')->name('admin.order.details');

    Route::get('/admin/confirmed/order' , 'AdminConfirmedOrder')->name('admin.confirmed.order');

    Route::get('/admin/processing/order' , 'AdminProcessingOrder')->name('admin.processing.order');

 Route::get('/admin/delivered/order' , 'AdminDeliveredOrder')->name('admin.delivered.order');

 Route::get('/pending/confirm/{order_id}' , 'PendingToConfirm')->name('pending-confirm');
 Route::get('/confirm/processing/{order_id}' , 'ConfirmToProcess')->name('confirm-processing');

  Route::get('/processing/delivered/{order_id}' , 'ProcessToDelivered')->name('processing-delivered');

  Route::get('/admin/invoice/download/{order_id}' , 'AdminInvoiceDownload')->name('admin.invoice.download');

});
Route::get('/condition', function(){
    return view('frontend.conditions.condition');
})->name('condition');
Route::get('/rules', function(){
    return view('frontend.conditions.rules');
})->name('rules');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });


    Route::middleware(['auth'])->group(function() {

        Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');


    }); // Gorup Milldeware End

Route::get('/product/details/{id}/{slug}', [HomeController::class, 'ProductDetails']);

Route::get('/product/category/{id}/{slug}', [HomeController::class, 'CatWiseProduct']);

Route::get('/product/subcategory/{id}/{slug}', [HomeController::class, 'SubCatWiseProduct']);
Route::get('/product/view/modal/{id}', [HomeController::class, 'ProductViewAjax']);


  // Route for viewing product details in the modal
Route::get('/product/view/modal/{id}', [HomeController::class, 'ProductViewAjax']);

// Route for adding product to cart
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::post('/cart/product/add/{id}', [CartController::class, 'AddToCart']);

Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::controller(CartController::class)->group(function(){
    Route::get('/mycart' , 'MyCart')->name('mycart');
    Route::get('/get-cart-product' , 'GetCartProduct');

    Route::get('/cart-decrement/{rowId}' , 'CartDecrement');
    Route::get('/cart-increment/{rowId}' , 'CartIncrement');


});

Route::post('/coupon-apply', [CouponController::class, 'ApplyCoupon']);
Route::get('/coupon-calculation', [CouponController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CouponController::class, 'CouponRemove']);


 // Admin Order All Route
 Route::controller(OrderController::class)->group(function(){
    Route::get('/pending/order' , 'PendingOrder')->name('pending.order');


});







 // Shipping District All Route
Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/district' , 'AllDistrict')->name('all.district');
    Route::get('/add/district' , 'AddDistrict')->name('add.district');
    Route::post('/store/district' , 'StoreDistrict')->name('store.district');
    Route::get('/edit/district/{id}' , 'EditDistrict')->name('edit.district');
    Route::post('/update/district' , 'UpdateDistrict')->name('update.district');
    Route::get('/delete/district/{id}' , 'DeleteDistrict')->name('delete.district');

});


 // Shipping State All Route
Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/state' , 'AllState')->name('all.state');
    Route::get('/add/state' , 'AddState')->name('add.state');
    Route::post('/store/state' , 'StoreState')->name('store.state');
    Route::get('/edit/state/{id}' , 'EditState')->name('edit.state');
    Route::post('/update/state' , 'UpdateState')->name('update.state');
    Route::get('/delete/state/{id}' , 'DeleteState')->name('delete.state');

    Route::get('/district/ajax/{division_id}' , 'GetDistrict');

});

// Shipping Division All Route
Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/division' , 'AllDivision')->name('all.division');
    Route::get('/add/division' , 'AddDivision')->name('add.division');
    Route::post('/store/division' , 'StoreDivision')->name('store.division');
    Route::get('/edit/coupon/{id}' , 'EditCoupon')->name('edit.coupon');
    Route::post('/update/coupon' , 'UpdateCoupon')->name('update.coupon');
    Route::get('/delete/coupon/{id}' , 'DeleteCoupon')->name('delete.coupon');

});
Route::get('/pay-now', [PaymentController::class, 'createPayment'])->name('pay.page');
Route::get('/payment-success', [PaymentController::class, 'paymentSuccess']);
Route::get('/payment-cancel', [PaymentController::class, 'paymentCancel']);



Route::controller(AllUserController::class)->group(function(){
    Route::get('/user/account/page' , 'UserAccount')->name('user.account.page');
    Route::get('/user/change/password' , 'UserChangePassword')->name('user.change.password');

    Route::get('/user/order/page' , 'UserOrderPage')->name('user.order.page');

    Route::get('/user/order_details/{order_id}' , 'UserOrderDetails');
    Route::get('/user/invoice_download/{order_id}' , 'UserOrderInvoice');

    Route::post('/return/order/{order_id}' , 'ReturnOrder')->name('return.order');

    Route::get('/return/order/page' , 'ReturnOrderPage')->name('return.order.page');

     // Order Tracking
     Route::get('/user/track/order' , 'UserTrackOrder')->name('user.track.order');
     Route::post('/order/tracking' , 'OrderTracking')->name('order.tracking');


   });

   Route::middleware(['auth', \App\Http\Middleware\Role::class . ':user'])->group(function () {

    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('/all/user', 'AllUser')->name('all-user');
    });
 // User Dashboard All Route

    // User Dashboard All Route
 Route::controller(AllUserController::class)->group(function(){
    Route::get('/user/account/page' , 'UserAccount')->name('user.account.page');



});
 // Wishlist All Route
 Route::controller(WishlistController::class)->group(function(){
    Route::get('/wishlist' , 'AllWishlist')->name('wishlist');
    Route::get('/get-wishlist-product' , 'GetWishlistProduct');
    Route::get('/wishlist-remove/{id}' , 'WishlistRemove');

});
});
Route::post('/recharge/import', [ProductController::class, 'storeExcel'])->name('recharge.storeExcel');


Route::middleware([RoleMiddleware::class.':admin'])->group(function(){
    Route::get('/admin' , [AdminHomeController::class, 'index'])->name('home.page');
    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brand' , 'AllBrand')->name('all.brand');
        Route::get('/add/brand' , 'AddBrand')->name('add.brand');
        Route::post('/store/brand' , 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}' , 'EditBrand')->name('edit.brand');
        Route::post('/update/brand' , 'UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}' , 'DeleteBrand')->name('delete.brand');
    });
    // Category All Route
Route::controller(CategoryController::class)->group(function(){
    Route::get('/all/category' , 'AllCategory')->name('all.category');
    Route::get('/add/category' , 'AddCategory')->name('add.category');
    Route::post('/store/category' , 'StoreCategory')->name('store.category');
    Route::get('/edit/category/{id}' , 'EditCategory')->name('edit.category');
    Route::post('/category/update/{id}', [CategoryController::class, 'UpdateCategory'])->name('update.category');
    Route::get('/delete/category/{id}' , 'DeleteCategory')->name('delete.category');

});
Route::controller(SubCategoryController::class)->group(function(){
    Route::get('/all/subcategory' , 'AllSubCategory')->name('all.subcategory');
    Route::get('/add/subcategory' , 'AddSubCategory')->name('add.subcategory');
    Route::post('/store/subcategory' , 'StoreSubCategory')->name('store.subcategory');
    Route::get('/edit/subcategory/{id}' , 'EditSubCategory')->name('edit.subcategory');
    Route::post('/update/subcategory' , 'UpdateSubCategory')->name('update.subcategory');
    Route::get('/delete/subcategory/{id}' , 'DeleteSubCategory')->name('delete.subcategory');

    Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');
});

Route::get('/subsubcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);


 Route::controller(SubSubCategoryController::class)->group(function(){
    Route::get('/all/subsubcategory' , 'AllSubSubCategory')->name('all.subsubcategory');
    Route::get('/add/subsubcategory' , 'AddSubSubCategory')->name('add.subsubcategory');
    Route::post('/store/subsubcategory' , 'StoreSubSubCategory')->name('store.subsubcategory');
    Route::get('/edit/subsubcategory/{id}' , 'EditSubSubCategory')->name('edit.subsubcategory');
    Route::post('/update/subsubcategory' , 'UpdateSubSubCategory')->name('update.subsubcategory');
    Route::get('/delete/subsubcategory/{id}' , 'DeleteSubSubCategory')->name('delete.subsubcategory');
});
 // Product All Route
 Route::controller(ProductController::class)->group(function(){
    Route::get('/all/product' , 'AllProduct')->name('all.product');
    Route::get('/add/product' , 'AddProduct')->name('add.product');
    Route::post('/store/product' , 'StoreProduct')->name('store.product');
    Route::get('/edit/product/{id}' , 'EditProduct')->name('edit.product');
    Route::put('/update/product' , 'UpdateProduct')->name('update.product');
    Route::post('/update/product/thambnail' , 'UpdateProductThambnail')->name('update.product.thambnail');
    Route::post('/update/product/multiimage' , 'UpdateProductMultiimage')->name('update.product.multiimage');
    Route::get('/product/multiimg/delete/{id}' , 'MulitImageDelelte')->name('product.multiimg.delete');

    Route::get('/product/inactive/{id}' , 'ProductInactive')->name('product.inactive');
    Route::get('/product/active/{id}' , 'ProductActive')->name('product.active');
    Route::get('/delete/product/{id}' , 'ProductDelete')->name('delete.product');
    // For Product Stock
     Route::get('/product/stock' , 'ProductStock')->name('product.stock');


});
Route::controller(ProductController::class)->group(function () {
    Route::get('/all/recharge', 'AllRecharge')->name('all.recharge');
    Route::get('/add/recharge', 'AddRecharge')->name('add.recharge');
    Route::post('/store/recharge', 'StoreRecharge')->name('store.recharge');
    Route::get('/edit/recharge/{id}', 'EditRecharge')->name('edit.recharge');
    Route::put('/update/recharge/{id}', 'UpdateRecharge')->name('update.recharge');
    Route::get('/delete/recharge/{id}', 'DeleteRecharge')->name('delete.recharge');
});
Route::put('/update/product/{id}', [ProductController::class, 'UpdateProduct'])->name('update.product');

 // Slider All Route
 Route::controller(SliderController::class)->group(function(){
    Route::get('/all/slider' , 'AllSlider')->name('all.slider');
    Route::get('/add/slider' , 'AddSlider')->name('add.slider');
    Route::post('/store/slider' , 'StoreSlider')->name('store.slider');
    Route::get('/edit/slider/{id}' , 'EditSlider')->name('edit.slider');
    Route::post('/update/slider' , 'UpdateSlider')->name('update.slider');
    Route::get('/delete/slider/{id}' , 'DeleteSlider')->name('delete.slider');

});
 // Banner All Route
 Route::controller(BannerController::class)->group(function(){
    Route::get('/all/banner' , 'AllBanner')->name('all.banner');
    Route::get('/add/banner' , 'AddBanner')->name('add.banner');
    Route::post('/store/banner' , 'StoreBanner')->name('store.banner');
    Route::get('/edit/banner/{id}' , 'EditBanner')->name('edit.banner');
    Route::post('/update/banner' , 'UpdateBanner')->name('update.banner');
    Route::get('/delete/banner/{id}' , 'DeleteBanner')->name('delete.banner');

});
// Admin Reviw All Route
Route::controller(ReviewController::class)->group(function(){

    Route::get('/pending/review' , 'PendingReview')->name('pending.review');
    Route::get('/review/approve/{id}' , 'ReviewApprove')->name('review.approve');
    Route::get('/publish/review' , 'PublishReview')->name('publish.review');
    Route::get('/review/delete/{id}' , 'ReviewDelete')->name('review.delete');
   });
   Route::controller(ReviewController::class)->group(function(){

    Route::post('/store/review' , 'StoreReview')->name('store.review');

   });

   // Banner All Route
   Route::controller(CouponController::class)->group(function(){
      Route::get('/all/coupon' , 'AllCoupon')->name('all.coupon');
      Route::get('/add/coupon' , 'AddCoupon')->name('add.coupon');
      Route::post('/store/coupon' , 'StoreCoupon')->name('store.coupon');
      Route::get('/edit/coupon/{id}' , 'EditCoupon')->name('edit.coupon');
      Route::post('/update/coupon' , 'UpdateCoupon')->name('update.coupon');
      Route::get('/delete/coupon/{id}' , 'DeleteCoupon')->name('delete.coupon');

  });


 // Shipping Division All Route
 Route::controller(ShippingAreaController::class)->group(function(){
    Route::get('/all/division' , 'AllDivision')->name('all.division');
    Route::get('/add/division' , 'AddDivision')->name('add.division');
    Route::post('/store/division' , 'StoreDivision')->name('store.division');
    Route::get('/edit/division/{id}' , 'EditDivision')->name('edit.division');
    Route::post('/update/division' , 'UpdateDivision')->name('update.division');
    Route::get('/delete/division/{id}' , 'DeleteDivision')->name('delete.division');

});

    });

    Route::get('/cart-remove/{rowId}', [CartController::class, 'CartRemove'])->name('cart.remove');
