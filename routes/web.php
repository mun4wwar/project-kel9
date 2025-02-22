<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\TransactionController;


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);


Route::get('/', [HomeController::class, 'home']);

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

// Route khusus admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', function () {
        return view('admin.index'); // Ganti dengan view admin Anda
    })->name('admin.dashboard');
});

// Route khusus user
Route::middleware('auth')->group(function () {
    Route::get('/user-dashboard', function () {
        return view('home.index'); // Ganti dengan view user Anda
    })->name('user.dashboard');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//Admin
Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth', 'admin']);
Route::post('add_category', [AdminController::class, 'add_category'])->middleware(['auth', 'admin']);
Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->middleware(['auth', 'admin']);
Route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->middleware(['auth', 'admin']);
Route::post('update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth', 'admin']);
Route::get('add_product', [AdminController::class, 'add_product'])->middleware(['auth', 'admin']);
Route::post('upload_product', [AdminController::class, 'upload_product'])->middleware(['auth', 'admin']);
Route::get('view_product', [AdminController::class, 'view_product'])->middleware(['auth', 'admin']);
Route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->middleware(['auth', 'admin']);
Route::put('update_product/{id}', [AdminController::class, 'update_product'])->middleware(['auth', 'admin']);
Route::get('edit_product/{id}', [AdminController::class, 'edit_product'])->middleware(['auth', 'admin']);
Route::get('product_search', [AdminController::class, 'product_search'])->middleware(['auth', 'admin']);
Route::get('view_orders', [AdminController::class, 'view_order'])->middleware(['auth', 'admin']);
Route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])->middleware(['auth', 'admin']);
Route::get('delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth', 'admin']);
Route::get('print_pdf/{id}', [AdminController::class, 'print_pdf'])->middleware(['auth', 'admin']);
Route::get('invoice/{orderId}', [AdminController::class, 'showInvoice'])->name('invoice.show');
Route::get('laporan_penjualan', [AdminController::class, 'laporan_penjualan'])->middleware(['auth', 'admin']);
Route::get('/confirm_payment/{id}', [AdminController::class, 'confirmPayment'])->name('confirm_payment')->middleware(['auth', 'admin']);
Route::get('send_invoice/{orderId}', [AdminController::class, 'sendInvoice'])->name('send_invoice')->middleware(['auth', 'admin']);



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('bahan', [BahanBakuController::class, 'index'])->name('bahan.index');
    Route::get('bahan/create', [BahanBakuController::class, 'create'])->name('bahan.create');
    Route::post('bahan', [BahanBakuController::class, 'store'])->name('bahan.store');
    Route::get('bahan/{id_bahanbaku}/edit', [BahanBakuController::class, 'edit'])->name('bahan.edit');
    Route::put('bahan/{id_bahanbaku}', [BahanBakuController::class, 'update'])->name('bahan.update');
    Route::delete('bahan/{id_bahanbaku}', [BahanBakuController::class, 'destroy'])->name('bahan.destroy');
});


//Supplier
Route::get('supplier', [SupplierController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('add_supplier', [SupplierController::class, 'add_supplier'])->middleware(['auth', 'admin']);
Route::post('upload_supplier', [SupplierController::class, 'upload_supplier'])->name('upload_supplier')->middleware(['auth', 'admin']);
Route::get('edit_supplier/{id}', [SupplierController::class, 'edit_supplier'])->middleware(['auth', 'admin']);
Route::post('update_supplier/{id}', [SupplierController::class, 'update_supplier'])->middleware(['auth', 'admin']);
Route::get('delete_supplier/{id}', [SupplierController::class, 'delete_supplier'])->middleware(['auth', 'admin']);


// User
Route::get('product_details/{id}', [HomeController::class, 'product_details']);
Route::get('add_cart/{id}', [HomeController::class, 'add_cart'])->middleware(['auth', 'verified']);
Route::get('/mycart', [HomeController::class, 'mycart'])->name('mycart')->middleware(['auth', 'verified']);
Route::get('delete_cart/{id}', [HomeController::class, 'delete_cart'])->middleware(['auth', 'verified']);
Route::post('/update_cart_quantity/{id}', [HomeController::class, 'updateQuantity'])->middleware(['auth', 'verified']);
Route::get('orders', [HomeController::class, 'myorders'])->name('orders_page')->middleware(['auth', 'verified']);
Route::get('shop', [HomeController::class, 'view_shop'])->name('shop');
Route::get('checkoutPage', [HomeController::class, 'showCheckout'])->name('checkoutPage')->middleware(['auth', 'verified']);
// Memproses checkout
Route::middleware('auth')->group(function () {
    Route::post('/processCheckout', [HomeController::class, 'checkout'])->name('processCheckout')->middleware(['auth', 'verified']);
    Route::get('/payment/bank-transfer', [HomeController::class, 'bankTransferPage'])->name('bankTransfer')->middleware(['auth', 'verified']);
    Route::get('/payment/credit-card', [HomeController::class, 'creditCardPage'])->name('creditCard')->middleware(['auth', 'verified']);
});

// proses pembayaran User
Route::post('/transaction/upload', [TransactionController::class, 'upload'])->name('transaction.upload')->middleware(['auth', 'verified']);

// Header navigation
Route::get('/tentang-kami', [HomeController::class, 'tentang_kami'])->middleware(['auth', 'verified']);
