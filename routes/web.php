<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('index', [DashboardController::class, 'index'])->name('index');
    });

    // Role
    Route::prefix('role')->name('role.')->group(function () {
        // Danh Sách Phân Quyền
        Route::get('list', [RoleController::class, 'list'])->name('list');
        // Thêm Mới Phân Quyền 
        Route::middleware('boss')->get('add', [RoleController::class, 'addForm'])->name('addForm');
        Route::middleware('boss')->post('add', [RoleController::class, 'postAdd'])->name('postAdd');
        // Xóa Phân Quyền
        Route::middleware('boss')->delete('delete/{role}', [RoleController::class, 'delete'])->name('delete');
        // Cập Nhật Phân Quyền
        Route::middleware('boss')->get('update/{role}', [RoleController::class, 'updateForm'])->name('updateForm');
        Route::middleware('boss')->put('update/{role}', [RoleController::class, 'putUpdate'])->name('putUpdate');
    });

    // User
    Route::prefix('user')->name('user.')->group(function () {
        // Danh Sách Người Dùng
        Route::get('list', [UserController::class, 'list'])->name('list');
        // Thay Đổi Trạng Thái Tài Khoản
        Route::put('change/{user}', [UserController::class, 'changeStatus'])->name('changeStatus');
        // Xóa Tài Khoản
        Route::delete('delete/{user}', [UserController::class, 'delete'])->name('delete');
        // Thêm Mới Admin 
        Route::middleware('boss')->get('add', [UserController::class, 'addForm'])->name('addForm');
        Route::middleware('boss')->post('add', [UserController::class, 'postAdd'])->name('postAdd');
    });

    // Category
    Route::prefix('category')->name('category.')->group(function () {
        // Danh Sách Danh Mục
        Route::get('list', [CategoryController::class, 'list'])->name('list');
        // Thêm Mới Danh Mục 
        Route::get('add', [CategoryController::class, 'addForm'])->name('addForm');
        Route::post('add', [CategoryController::class, 'postAdd'])->name('postAdd');
        //Xóa Danh Mục
        Route::delete('delete/{category}', [CategoryController::class, 'delete'])->name('delete');
        // Cập Nhật Danh Mục
        Route::middleware('boss')->get('update/{category}', [CategoryController::class, 'updateForm'])->name('updateForm');
        Route::middleware('boss')->put('update/{category}', [CategoryController::class, 'putUpdate'])->name('putUpdate');
    });

    // Product
    Route::prefix('product')->name('product.')->group(function () {
        // Danh Sách Sản Phẩm
        Route::get('list', [ProductController::class, 'list'])->name('list');
        // Thay Đổi Trạng Thái Sản Phẩm
        Route::put('change{product}', [ProductController::class, 'changeStatus'])->name('changeStatus');
        // Danh Sách Ảnh Sản Phẩm
        Route::get('image/{product}', [ProductController::class, 'image'])->name('image');
        // Xóa Sản Phẩm
        Route::delete('delete/{product}', [ProductController::class, 'delete'])->name('delete');
        // Thêm Sản Phẩm
        Route::get('add', [ProductController::class, 'addForm'])->name('addForm');
        Route::post('add', [ProductController::class, 'postAdd'])->name('postAdd');
        // Cập Nhật Sản Phẩm
        Route::get('update/{product}', [ProductController::class, 'updateForm'])->name('updateForm');
        Route::put('update/{product}', [ProductController::class, 'putUpdate'])->name('putUpdate');
    });

    // Image
    Route::prefix('image')->name('image.')->group(function () {
        // Danh Sách Ảnh Sản Phẩm
        Route::get('list', [ImageController::class, 'list'])->name('list');
        // Thêm Ảnh Sản Phẩm
        Route::get('add/{product}', [ImageController::class, 'addForm'])->name('addForm');
        Route::post('add/{product}', [ImageController::class, 'postAdd'])->name('postAdd');
        // Xóa Ảnh Sản Phẩm
        Route::delete('delete/{image}', [ImageController::class, 'delete'])->name('delete');
        // Cập Nhật Ảnh
        Route::get('update/{img}', [ImageController::class, 'updateForm'])->name('updateForm');
        Route::put('update/{img}', [ImageController::class, 'putUpdate'])->name('putUpdate');
    });
    // Order
    Route::prefix('order')->name('order.')->group(function () {
        // Danh Sách Đơn Hàng
        Route::get('list', [OrderController::class, 'list'])->name('list');
        // Chi Tiết Đơn Hàng
        Route::get('detail/{order}', [OrderController::class, 'detail'])->name('detail');
        // Giao Hàng
        Route::put('delivery/{order}', [OrderController::class, 'delivery'])->name('delivery');
        // Hoàn Tất
        Route::put('success/{order}', [OrderController::class, 'success'])->name('success');
        
    });
    // Statistical
    Route::prefix('statistical')->name('statistical.')->group(function () {
        // Danh Sách Đơn Hàng
        Route::get('index', [StatisticalController::class, 'index'])->name('index');
    });
});

// Web
Route::prefix('web')->name('web.')->group(function () {
    // Auth
    Route::prefix('auth')->name('auth.')->group(function () {
        // Login
        Route::middleware('guest')->get('login', [AuthController::class, 'loginForm'])->name('loginForm');
        Route::middleware('guest')->post('login', [AuthController::class, 'postLogin'])->name('postLogin');
        // Logout
        Route::middleware('auth')->get('logout', [AuthController::class, 'logout'])->name('logout');
        // Register
        Route::middleware('guest')->get('register', [AuthController::class, 'registerForm'])->name('registerForm');
        Route::middleware('guest')->post('register', [AuthController::class, 'postRegister'])->name('postRegister');
        // Quên Mật Khẩu
        Route::middleware('guest')->get('forgot-password', [AuthController::class, 'forgotForm'])->name('forgotForm');
        Route::middleware('guest')->post('forgot-password', [AuthController::class, 'postForgot'])->name('postForgot');
        // Xác Nhận Mã Code
        Route::middleware('guest')->get('xac-thuc', [AuthController::class, 'confirmForm'])->name('confirmForm');
        Route::middleware('guest')->post('xac-thuc', [AuthController::class, 'postConfirm'])->name('postConfirm');
        // Đổi Mật Khẩu
        Route::middleware('guest')->get('doi-mat-khau', [AuthController::class, 'resetForm'])->name('resetForm');
        Route::middleware('guest')->post('doi-mat-khau', [AuthController::class, 'postReset'])->name('postReset');
        // Liên Hệ
        Route::middleware('auth')->get('contact', [AuthController::class, 'contact'])->name('contact');
        // Thông Tin User
        Route::middleware('auth')->get('info', [AuthController::class, 'info'])->name('info');
        // Cập Nhật User
        Route::middleware('auth')->post('updateUser', [AuthController::class, 'updateUser'])->name('updateUser');
        Route::middleware('auth')->post('update_u', [AuthController::class, 'update_u'])->name('update_u');

        
    });
    // Product
    Route::prefix('product')->name('product.')->group(function () {
        // Chi Tiết Sản Phẩm
        Route::get('detail/{product}', [ProductController::class, 'detailProduct'])->name('detail');
        // Hiển Thị Các Sản Phẩm
        Route::get('index', [ProductController::class, 'index'])->name('index');
        // Tìm Kiếm Sản Phẩm
        Route::post('search', [ProductController::class, 'search'])->name('search');
        // Tìm Kiếm Theo Danh Mục
        Route::get('category/{id}', [ProductController::class, 'category'])->name('category');
    });

    //
    Route::middleware('auth')->prefix('order')->name('order.')->group(function () {
        // Add-to-cart
        Route::post('add-to-cart/{product}', [OrderController::class, 'postAdd'])->name('postAdd');
        // Show cart
        Route::get('cart/danh-sach', [OrderController::class, 'showCart'])->name('showCart');
        // Xóa Sản Phẩm Trong Cart
        Route::delete('delete/{cart}', [OrderController::class, 'delete'])->name('delete');
        // Thay đổi số lượng sản phẩm
        Route::put('change/{cart}', [OrderController::class, 'change'])->name('change');
        // Thanh Toán
        Route::get('pay', [OrderController::class, 'pay'])->name('pay');
        // Xử lý đơn hàng
        Route::put('xu-ly/{order}', [OrderController::class, 'handle'])->name('handle');
        // Danh sách đơn hàng user đã đăng nhập
        Route::get('don-hang', [OrderController::class, 'showOrder'])->name('showOrder');
        // Chi Tiết Đơn Hàng
        Route::get('detail/{order}', [OrderController::class, 'detail_u'])->name('detail_u');
        // Xóa Đơn Hàng
        Route::delete('destroy/{order}', [OrderController::class, 'destroy'])->name('destroy');
    });
// Comment
    Route::middleware('auth')->prefix('comment')->name('comment.')->group(function () {
        // Gửi Đánh Giá
        Route::post('evaluate/{product}', [CommentController::class, 'postAdd'])->name('postAdd');
    });
});
