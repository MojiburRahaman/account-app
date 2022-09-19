 <?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\BestDealController;
    use App\Http\Controllers\BrandController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\CatagoryController;
    use App\Http\Controllers\ColorController;
    use App\Http\Controllers\FlavourController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\ProductViewController;
    use App\Http\Controllers\SearchController;
    use App\Http\Controllers\SizeController;
    use App\Http\Controllers\SubCatagoryController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\CouponController;
    use App\Http\Controllers\WishlistController;
    use App\Http\Controllers\BlogController;
    use App\Http\Controllers\UserProfileController;
    use App\Http\Controllers\CheckoutController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\SiteSettingController;
    use App\Http\Controllers\SocialLoginController;
    use App\Http\Controllers\DepotController;
    use App\Http\Controllers\PaymentmethodController;
    use App\Http\Controllers\BankController;
    use App\Http\Controllers\Frontend\FrontendController;

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    // socialite
    Route::get('login/google', [SocialLoginController::class, 'GoogleLogin'])->name('GoogleLogin');
    Route::get('register/google', [SocialLoginController::class, 'GoogleRegister'])->name('GoogleRegister');
    Route::get('login/callback', [SocialLoginController::class, 'GoogleCallbackUrlRegister'])->name('GoogleCallbackUrlRegister');


    // Auth::routes(['verify' => true]);

    // frontend route start
    Route::middleware(['HtmlMinify', 'XssFilter'])->group(function () {

        Route::get('/', [FrontendController::class, 'Frontendhome'])->name('Frontendhome')->middleware('auth');
    });

    // cart route end
    // Route::middleware(['auth', 'XssFilter', 'HtmlMinify', 'checkcoustomer'])->group(function () {
    //     // Profile route
    //     Route::get('/profile', [UserProfileController::class, 'FrontendProfile'])->name('FrontendProfile');
    //     Route::post('/change-password', [UserProfileController::class, 'ChangeUserPass'])->name('ChangeUserPass');
    //     // wishlist route start
    //     Route::get('/wishlist', [WishlistController::class, 'WishlistView'])->name('WishlistView');
    //     Route::post('/wishlist-post', [WishlistController::class, 'WishlistPost'])->name('WishlistPost');
    //     Route::get('/wishlist-remove/{id}', [WishlistController::class, 'WishlistRemove'])->name('WishlistRemove');
    //     // checkout route start
    //     Route::get('/checkout', [CheckoutController::class, 'CheckoutView'])->name('CheckoutView');
    //     Route::post('/checkout-post', [CheckoutController::class, 'CheckoutPost'])->name('CheckoutPost');
    //     Route::post('/checkout/billing/division_id', [CheckoutController::class, 'CheckoutajaxDivid'])->name('CheckoutajaxDivid');
    //     Route::post('/checkout/billing/disctrict_id', [CheckoutController::class, 'CheckoutajaxDistrictid'])->name('CheckoutajaxDistrictid');
    // });


    // Route::get('/admin/login', [DashboardController::class, 'AdminLogin'])->name('AdminLogin')->middleware('guest', 'throttle:10,5');
    // Route::post('/admin/login', [DashboardController::class, 'AdminLoginPost'])->name('AdminLoginPost')->middleware('guest', 'throttle:10,5');
    // backend route start
    Route::middleware(['auth',  'HtmlMinify', 'checkadminpanel'])->prefix('admin')->group(function () {

        Route::get('/change-password', [DashboardController::class, 'AdminChangePassword'])->name('AdminChangePassword');
        Route::post('/change-password', [DashboardController::class, 'AdminChangePasswordPost'])->name('AdminChangePasswordPost');
        Route::resource('dashboard', DashboardController::class)->except('destroy', 'update', 'edit', 'show', 'store', 'create');
        // catagory route 
        Route::post('/catagory/mark-delete', [CatagoryController::class, 'MarkdeleteCatagory'])->name('MarkdeleteCatagory');
        Route::post('/depot/mark-delete', [DepotController::class, 'MarkdeleteDepot'])->name('MarkdeleteDepot');
        Route::resource('/catagory', CatagoryController::class);

        Route::resource('/depot', DepotController::class);

        Route::resource('/payment-method', PaymentmethodController::class);
        Route::post('/method/mark-delete', [PaymentmethodController::class, 'MarkdeleteMethod'])->name('MarkdeleteMethod');
        // subcatagory route
        Route::post('/sub-catagory/mark-delete', [SubCatagoryController::class, 'MarkdeleteSubCatagory'])->name('MarkdeleteSubCatagory');
        Route::resource('/subcatagory', SubCatagoryController::class)->except('show');
        Route::resource('/bank', BankController::class);
        Route::post('/bank/mark-delete', [BankController::class, 'MarkdeleteBank'])->name('MarkdeleteBank');

        // product route
        Route::get('/products/status/{id}', [ProductController::class, 'ProductStaus'])->name('ProductStaus');
        Route::post('/products/mark-delete/', [ProductController::class, 'MarkdeleteProduct'])->name('MarkdeleteProduct');
        Route::get('/products/edit/product-attribute-delete/{id}', [ProductController::class, 'ProducvtAtributeDelete'])->name('ProducvtAtributeDelete');
        // Route::get('/products/edit/product-flavour-delete/{id}', [ProductController::class, 'ProductFlavourDelete'])->name('ProductFlavourDelete');
        Route::get('/products/edit/product-image-delete/{id}', [ProductController::class, 'ProductImagesDelete'])->name('ProductImagesDelete');
        Route::get('/products/get-sub-cat/{cat_id}', [ProductController::class, 'GetSubcatbyAjax'])->name('GetSubcatbyAjax');
        Route::resource('/products', ProductController::class);
        // brand route 
        Route::post('/brand/mark-delete', [BrandController::class, 'Markdeletebrand'])->name('Markdeletebrand');
        Route::resource('/brand', BrandController::class)->except('show');
        //    roles route
        Route::post('/roles/reset-password', [RoleController::class, 'ResetPassPost'])->name('ResetPassPost');
        Route::get('/roles/reset-password', [RoleController::class, 'ResetPass'])->name('ResetPass');
        Route::get('/roles/add-user', [RoleController::class, 'CreateUser'])->name('CreateUser');
        Route::post('/roles/add-user-post', [RoleController::class, 'CreateUserPost'])->name('CreateUserPost');
        Route::post('/roles/assign-user-post', [RoleController::class, 'AssignUserPost'])->name('AssignUserPost');
        Route::get('/roles/assign-user', [RoleController::class, 'AssignUser'])->name('AssignUser');
        Route::resource('/roles', RoleController::class)->except('show');
        // order route
        Route::get('orders/status/{id}', [OrderController::class, 'DeliveryStatus'])->name('DeliveryStatus');
        Route::get('orders/download-invoice/{id}', [OrderController::class, 'InvoiceDownload'])->name('InvoiceDownload');
        Route::resource('/orders', OrderController::class)->except('create', 'store', 'edit', 'destroy', 'update');

        Route::get('settings/about/{id}', [SiteSettingController::class, 'SiteAbout'])->name('SiteAbout');
        Route::post('settings/about', [SiteSettingController::class, 'SiteAboutUpdate'])->name('SiteAboutUpdate');
        Route::get('settings/banner-status/{id}', [SiteSettingController::class, 'SiteBannerStatus'])->name('SiteBannerStatus');
        Route::get('settings/banner-delete/{id}', [SiteSettingController::class, 'SiteBannerDelete'])->name('SiteBannerDelete');
        Route::post('settings/banner-post', [SiteSettingController::class, 'SiteBannerPost'])->name('SiteBannerPost');
        Route::get('settings/banner', [SiteSettingController::class, 'SiteBanner'])->name('SiteBanner');
        Route::post('settings/subscriber', [SiteSettingController::class, 'SiteSubscriber'])->name('SiteSubscriber');

        Route::resource('/settings', SiteSettingController::class)->except('show', 'destroy', 'index', 'store');
        Route::resource('/coupons', CouponController::class);
        Route::resource('/color', ColorController::class)->except('show');
        Route::resource('/size', SizeController::class)->except('show');
        Route::resource('/flavour', FlavourController::class)->except('create', 'index', 'store', 'edit', 'show', 'destroy', 'update');

        Route::post('blogs/ck-editor-upload', [BlogController::class, 'CkfileUpload'])->name('CkfileUpload');
        Route::resource('/blogs', BlogController::class);
        Route::resource('/deals', BestDealController::class)->except('edit', 'update');
    });


    require __DIR__ . '/auth.php';

    // Auth::routes();
