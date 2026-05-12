<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminChatController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// ─────────────────────────────────────────────
// Broadcasting Auth
// ─────────────────────────────────────────────
Route::post('/broadcasting/auth', function (Request $request) {
    $customerId = session('customer_id');

    if (!$customerId) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $channelName = $request->input('channel_name');
    $socketId    = $request->input('socket_id');

    if (str_starts_with($channelName, 'private-customer-')) {
        $requestedId = str_replace('private-customer-', '', $channelName);
        if ((string) $customerId !== (string) $requestedId) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
    }

    $pusher = new \Pusher\Pusher(
        config('broadcasting.connections.pusher.key'),
        config('broadcasting.connections.pusher.secret'),
        config('broadcasting.connections.pusher.app_id'),
        ['cluster' => config('broadcasting.connections.pusher.options.cluster'), 'useTLS' => true]
    );

    return response()->json(
        json_decode($pusher->authorizeChannel($channelName, $socketId), true)
    );

})->middleware('web')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);


// Temporary debug route — add near the top of web.php
Route::get('/debug-session', function () {
    return response()->json([
        'customer_id' => Session::get('customer_id'),
        'session_id'  => session()->getId(),
        'all'         => session()->all(),
    ]);
})->middleware('web');

// ─────────────────────────────────────────────
// Public Routes
// ─────────────────────────────────────────────

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', [MyShopController::class, 'index'])->name('home');
Route::get('/product-category/{id}', [MyShopController::class, 'category'])->name('product-category');
Route::get('/product-detail/{id}', [MyShopController::class, 'detail'])->name('product-detail');

Route::post('/add-to-cart/{id}', [CartController::class, 'index'])->name('add-to-cart');
Route::get('/show-cart', [CartController::class, 'show'])->name('show-cart');
Route::get('/remove-cart-item/{id}', [CartController::class, 'remove'])->name('remove-cart-item');
Route::post('/update-cart-item/{id}', [CartController::class, 'update'])->name('update-cart-item');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/new-cash-order', [CheckoutController::class, 'newCashOrder'])->name('new-cash-order');
Route::get('/complete-order', [CheckoutController::class, 'completeOrder'])->name('complete-order');

// ─────────────────────────────────────────────
// Guest Chat Routes (no login required)
// ─────────────────────────────────────────────

Route::post('/customer/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
Route::get('/customer/chat/fetch', [ChatController::class, 'fetchMessage'])->name('chat.fetch');

// ─────────────────────────────────────────────
// Customer Auth Routes
// ─────────────────────────────────────────────

Route::get('/customer-login', [CustomerAuthController::class, 'index'])->name('customer.login.view');
Route::post('/customer-login', [CustomerAuthController::class, 'login'])->name('customer-login');
Route::post('/customer-register', [CustomerAuthController::class, 'register'])->name('customer-register');

// ─────────────────────────────────────────────
// Customer Protected Routes
// ─────────────────────────────────────────────

Route::middleware('customer')->group(function () {
    Route::get('/customer/dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/profile', [CustomerAuthController::class, 'profile'])->name('customer.profile');
    Route::get('/customer/all-order', [CustomerOrderController::class, 'allOrder'])->name('customer.order');
    Route::get('/customer-logout', [CustomerAuthController::class, 'logout'])->name('customer-logout');
    Route::get('/customer/chat-support', [ChatController::class, 'index'])->name('customer.chat-support');
});

// ─────────────────────────────────────────────
// Admin Protected Routes
// ─────────────────────────────────────────────

Route::get('/dashboard', function () {
    return view('admin.home.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Category
    Route::get('/category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::post('/category/new', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/manage', [CategoryController::class, 'manage'])->name('category.manage');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // Sub-Category
    Route::get('/sub-category/add', [SubCategoryController::class, 'add'])->name('sub-category.add');
    Route::post('/sub-category/new', [SubCategoryController::class, 'create'])->name('sub-category.create');
    Route::get('/sub-category/manage', [SubCategoryController::class, 'manage'])->name('sub-category.manage');
    Route::get('/sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
    Route::post('/sub-category/update/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
    Route::get('/sub-category/delete/{id}', [SubCategoryController::class, 'delete'])->name('sub-category.delete');

    // Brand
    Route::get('/brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::post('/brand/new', [BrandController::class, 'create'])->name('brand.create');
    Route::get('/brand/manage', [BrandController::class, 'manage'])->name('brand.manage');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');

    // Unit
    Route::get('/unit/add', [UnitController::class, 'add'])->name('unit.add');
    Route::post('/unit/new', [UnitController::class, 'create'])->name('unit.create');
    Route::get('/unit/manage', [UnitController::class, 'manage'])->name('unit.manage');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::post('/unit/update/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::get('/unit/delete/{id}', [UnitController::class, 'delete'])->name('unit.delete');

    // Product
    Route::get('/product/add', [ProductController::class, 'index'])->name('product.add');
    Route::get('/get-subcategory-by-category', [ProductController::class, 'getSubCategoryByCategory'])->name('product.get-subcategory-by-category');
    Route::post('/product/new', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/manage', [ProductController::class, 'manage'])->name('product.manage');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');

    // Order
    Route::get('/admin/all-order', [AdminOrderController::class, 'index'])->name('admin.all-order');
    Route::get('/admin/order/detail/{id}', [AdminOrderController::class, 'detail'])->name('order.detail');
    Route::get('/admin/order/edit/{id}', [AdminOrderController::class, 'edit'])->name('order.edit');
    Route::post('/admin/update-order/{id}', [AdminOrderController::class, 'update'])->name('admin.update-order');
    Route::get('/admin/order-invoice/{id}', [AdminOrderController::class, 'showInvoice'])->name('admin.order-invoice');
    Route::get('/admin/print-invoice/{id}', [AdminOrderController::class, 'printInvoice'])->name('admin.print-invoice');
    Route::get('/admin/order-delete/{id}', [AdminOrderController::class, 'delete'])->name('admin.order-delete');

    // Admin Chat
    Route::get('/admin/chat', [AdminChatController::class, 'index'])->name('admin.chat.index');
    Route::get('/admin/chat/messages/{customerId}', [AdminChatController::class, 'getMessages'])->name('admin.chat.messages');
    Route::post('/admin/chat/send', [AdminChatController::class, 'sendMessage'])->name('admin.chat.send');
    Route::get('/admin/chat/customer/{id}', [AdminChatController::class, 'getCustomer']);

   

});

 Route::get('/home/about-us', [AboutUsController::class, 'index'])->name('home.about-us');
    Route::get('/home/contact-us', [ContactUsController::class, 'index'])->name('home.contact-us');

// ─────────────────────────────────────────────
// SSLCommerz
// ─────────────────────────────────────────────

Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);

require __DIR__.'/auth.php';