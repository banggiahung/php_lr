<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(HomeController::class)->group(
    function () {
        Route::get('/', 'Index')->name('Home');

    }
);
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(ClientController::class)->group(
        function () {
            Route::get('/user_profile', 'userProfile')->name('userProfile');
            Route::get('/add_to_card_product/{id}', 'addToCard')->name('addToCard');
            Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
        }
    );
});
Route::controller(ClientController::class)->group(
    function () {
        Route::any('/category/{id}/{slug}', 'CategoryPage')->name('Category');
        Route::get('/single_product/{id}/{slug}', 'singleProduct')->name('singleProduct');
        Route::get('/add_to_card_product/{id}', 'addToCard')->name('addToCard');
        Route::get('/checkout', 'Checkout')->name('Checkout');
        Route::get('/user_profile/pending-order', 'PendingOrder')->name('pendingOrderClient');
        Route::get('/user_profile/history', 'History')->name('history');
        Route::get('/user_profile', 'userProfile')->name('userProfile');
        Route::post('/remove_cart', 'remove')->name('remove_cart');
        Route::post('/add_cart', 'StoreOrder')->name('storeOrder');
        Route::get('/user_profile/shipping', 'mainShip')->name('mainShip');
        Route::post('/add_shipping', 'addShipping')->name('addShipping');
        Route::get('/user_profile/info-address', 'showShippingInfo')->name('showShippingInfo');
        Route::get('/user_profile/info-address/{id}', 'EditShipping')->name('EditShipping');
        Route::post('/user_profile/info-address/update-shipping', 'updateShipping')->name('updateShipping');
        Route::delete('user_profile/info-address/delete-ship/{id}', 'deleteShip')->name('deleteShip');
        Route::get('/user_profile/log-out', 'destroy')->name('logOut');
        Route::get('/category/{id}', 'sort_by')->name('sort_by');


    }
);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(
        function () {
            Route::get('/admin/dashboard', 'Index')->name('admindashboard');
            Route::get('/admin/log-out', 'destroy')->name('logOut');


        }
    );
    Route::controller(CategoryController::class)->group(
        function () {
            Route::get('/admin/all-category', 'Index')->name('allCategory');
            Route::post('/admin/store-category', 'StoreCategory')->name('storeCategory');
            Route::post('/admin/update-category', 'UpdateCategory')->name('updateCategory');
            Route::get('/admin/delete-category/{id}', 'DeleteCategory')->name('deleteCategory');
        }
    );
    Route::controller(OrderController::class)->group(
        function () {
            Route::get('/admin/pending-order', 'Index')->name('pendingOrder');

        }
    );
    Route::controller(ProductsController::class)->group(
        function () {
            Route::get('/admin/all-products', 'Index')->name('allProducts');
            Route::post('/admin/store-products', 'StoreProducts')->name('storeProducts');
            Route::post('/admin/update-Image-Products', 'updateImgProducts')->name('updateImageProducts');
            Route::post('/admin/update-Product', 'UpdateProducts')->name('updateProducts');
            Route::get('/admin/delete-Product/{id}', 'DeleteProduct')->name('deleteProduct');



        }
    );
    Route::controller(SubCategoryController::class)->group(
        function () {
            Route::get('/admin/all-subcategory', 'Index')->name('allSubCategory');
            Route::post('/admin/store-sub-category', 'StoreSubCategory')->name('storedSubCategory');
            Route::post('/admin/update-sub-category', 'UpdateSubCategory')->name('updateSubCategory');
            Route::get('/admin/delete-sub-category/{id}', 'DeleteSubCategory')->name('deleteSubCat');
        }
    );
});





require __DIR__ . '/auth.php';
