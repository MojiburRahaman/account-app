 <?php

    use Illuminate\Support\Facades\Route;

    
    use App\Http\Controllers\Backend\CollController;
    use App\Http\Controllers\Backend\BankController;
    use App\Http\Controllers\Backend\DashboardController;
    use App\Http\Controllers\Backend\DepotController;
    use App\Http\Controllers\Backend\OrderController;
    use App\Http\Controllers\Backend\PaymentmethodController;
    use App\Http\Controllers\Backend\RoleController;
    use Illuminate\Support\Facades\Auth;



    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    })->name('Frontendhome')->middleware('auth');




    // backend route start

    Route::middleware(['auth',  'HtmlMinify',])->prefix('admin')->group(function () {
        Route::get('/depotwisetotal', [CollController::class, 'depotwisetotal'])->name('depotwisetotal');
        Route::post('/depotwisetotal-collection', [CollController::class, 'depotwisetotalsearch'])->name('depotwisetotalsearch');
        Route::resource('/coll', CollController::class);
        Route::get('/change-password', [DashboardController::class, 'AdminChangePassword'])->name('AdminChangePassword');
        Route::post('/change-password', [DashboardController::class, 'AdminChangePasswordPost'])->name('AdminChangePasswordPost');
        Route::resource('dashboard', DashboardController::class)->except('destroy', 'update', 'edit', 'show', 'store', 'create');


        Route::post('/depot/mark-delete', [DepotController::class, 'MarkdeleteDepot'])->name('MarkdeleteDepot');
        Route::resource('/depot', DepotController::class);

        Route::resource('/payment-method', PaymentmethodController::class);
        Route::post('/method/mark-delete', [PaymentmethodController::class, 'MarkdeleteMethod'])->name('MarkdeleteMethod');


        Route::resource('/bank', BankController::class);
        Route::post('/bank/mark-delete', [BankController::class, 'MarkdeleteBank'])->name('MarkdeleteBank');

        //    roles route
        Route::post('/roles/reset-password', [RoleController::class, 'ResetPassPost'])->name('ResetPassPost');
        Route::get('/roles/reset-password', [RoleController::class, 'ResetPass'])->name('ResetPass');
        Route::get('/roles/add-user', [RoleController::class, 'CreateUser'])->name('CreateUser');
        Route::post('/roles/add-user-post', [RoleController::class, 'CreateUserPost'])->name('CreateUserPost');
        Route::post('/roles/assign-user-post', [RoleController::class, 'AssignUserPost'])->name('AssignUserPost');
        Route::get('/roles/assign-user', [RoleController::class, 'AssignUser'])->name('AssignUser');
        Route::resource('/roles', RoleController::class)->except('show');
        // order route

        Route::post('/orders/searchdetails', [OrderController::class, 'searchdetails'])->name('searchdetails');
        Route::post('/orders/searching', [OrderController::class, 'searching'])->name('searching');
        Route::get('orders/status/{id}', [OrderController::class, 'DeliveryStatus'])->name('DeliveryStatus');
        Route::get('orders/download-invoice/{id}', [OrderController::class, 'InvoiceDownload'])->name('InvoiceDownload');
        Route::get('/orders/indetails', [OrderController::class, 'indetails'])->name('indetails');
        Route::resource('/orders', OrderController::class)->except('create', 'store', 'edit', 'destroy', 'update');
    });


    require __DIR__ . '/auth.php';
