<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExamplesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PermissionBasedAccess;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductEnter;
use App\Http\Controllers\ProductsExit;
use App\Http\Controllers\ProductsIn;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleOrPermission;
use App\Http\Controllers\RolesAndPermissionsController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestSpatiePermission;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/php', function () {
    return phpinfo();
});

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth','verified'])->controller(ProfileController::class)->group(function(){
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        // Route::get('/dashboard', function () {
        //     return view('dashboard');
        // })->middleware(['auth', 'verified'])->name('dashboard');



        // Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/profile',  'edit')->name('profile.edit');
        Route::patch('/profile',  'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
});
Route::middleware(['auth','verified'])->controller(TestController::class)->group(function(){
    Route::get('/indexUserTest','index');
});




require __DIR__ . '/auth.php';



// // Create A Permission
// Route::get('/permissions/create', [TestSpatiePermission::class, 'create'])->name('spatie.permission.create');
// Route::post('/permissions', [TestSpatiePermission::class, 'store'])->name('spatie.permissions.store');
// //
// Route::get('/permissions/assign', [TestSpatiePermission::class, 'assignForm'])->name('permissions.assign');
// Route::post('/permissions/assign', [TestSpatiePermission::class, 'assign'])->name('permissions.assign');

// // #Sync Permissions To A Role
// Route::get('/permissions/sync', [TestSpatiePermission::class, 'syncForm'])->name('permissions.sync');
// Route::post('/permissions/sync', [TestSpatiePermission::class, 'sync'])->name('permissions.sync');

// // Remove Permission From A Role
// Route::get('/permissions/remove', [TestSpatiePermission::class, 'removeForm'])->name('permissions.remove');
// Route::post('/permissions/remove', [TestSpatiePermission::class, 'remove'])->name('permissions.remove');

// //  Guard Name
// // Get Permissions For A User
// Route::get('permission/users/{id}', [TestSpatiePermission::class, 'show'])->name('users.show');

// // Route to show the form for giving permissions
// Route::get('/permissions/give', [TestSpatiePermission::class, 'giveForm'])->name('permissions.give');

// // Route to handle the assignment of permissions
// Route::post('/permissions/give', [TestSpatiePermission::class, 'give'])->name('permissions.give.store');

// // Route to show the form for giving permissions
// Route::get('direct/permissions/give', [TestSpatiePermission::class, 'directPermissionGiveForm'])->name('permissions.give');

// // Route to handle the assignment of permissions
// Route::post('direct/permissions/give', [TestSpatiePermission::class, 'directPermissionGive'])->name('permissions.give.store');



// #########################
// Home Page
Route::controller(LandingController::class)->group(function () {
    Route::get('/', 'index');
});


Route::prefix('/test')->controller(TestController::class)->group(function(){
    Route::get('/customer', 'customerRetrive');
    Route::get('/supplier', 'supplierRetrive');
    Route::get('/category', 'categoryRetrive');
    Route::get('/unit', 'unitRetrive');
    Route::get('/product', 'productRetrive');
    // product-customergory relationship retrive
    Route::get('/categories/{id}/products','getProductsWithCategories');
    Route::get('/categories/{identifier}/products/{productId}','getProductByCategory');
    // customer-order-relationships
    Route::get('/orders-with-customers','getOrdersWithCustomers');
    Route::get('/orders/{id}/customer','getOrderWithCustomer');
    // order-orderdetail
    Route::get('/order-details-with-products','getAllOrderDetails');
    Route::get('/order-details/{id}','getOrderDetail');
    // Purchase-supplier
    Route::get('/purchases-with-suppliers','getAllPurchases');
    Route::get('/purchases/{id}','getPurchase');
    // Purchase-Details
    Route::get('/purchase-details-with-products','getAllPurchaseDetails');
    Route::get('/purchase-details/{id}','getPurchaseDetail');
    // index data
    Route::get('/index','index');
});
