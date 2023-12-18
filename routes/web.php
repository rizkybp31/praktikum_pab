<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\API\PaymentCallbackController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/user',
    [
        UserController::class, 'index'
    ]
);
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/user/create',
    [UserController::class, 'create']
);
Route::middleware(['auth:sanctum', 'admin'])->post(
    '/user/store',
    [UserController::class, 'store']
);
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/user/edit/{id}',
    [UserController::class, 'edit']
);
Route::middleware(['auth:sanctum', 'admin'])->post(
    '/user/update/{id}',
    [UserController::class, 'update']
);
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/user/editpassword/{id}',
    [UserController::class, 'editpassword']
);
Route::middleware(['auth:sanctum', 'admin'])->post(
    '/user/updatepassword/{id}',
    [UserController::class, 'updatepassword']
);
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/user/edituser/{id}',
    [UserController::class, 'edituser']
);
Route::middleware(['auth:sanctum', 'admin'])->post(
    '/user/updateuser/{id}',
    [UserController::class, 'updateuser']
);
Route::middleware(['auth:sanctum', 'admin'])->post(
    '/user/destroy/{id}',
    [UserController::class, 'destroy']
);
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/food',
    [FoodController::class, 'index']
);
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/food/create',
    [FoodController::class, 'create']
);
Route::middleware(['auth:sanctum', 'admin'])->post(
    '/food/store',
    [FoodController::class, 'store']
);
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/food/edit/{id}',
    [FoodController::class, 'edit']
);
Route::middleware(['auth:sanctum', 'admin'])->post(
    '/food/update/{id}',
    [FoodController::class, 'update']
);
Route::middleware(['auth:sanctum', 'admin'])->post(
    '/food/destroy/{id}',
    [FoodController::class, 'destroy']
);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});
Route::middleware(['auth:sanctum'])->get(
    '/transaction/order',
    [TransactionController::class, 'createorder']
);
Route::middleware(['auth:sanctum'])->post(
    '/transaction/order',
    [TransactionController::class, 'storeorder']
);
Route::middleware(['auth:sanctum'])->get(
    '/transaction/cart/{id}',
    [TransactionController::class, 'createcart']
);
Route::middleware(['auth:sanctum'])->post(
    '/transaction/cart/{id}',
    [TransactionController::class, 'storecart']
);
Route::middleware(['auth:sanctum'])->get(
    '/transaction/payment/{id}',
    function ($id) {
        return 'Berhasil';
    }
);
Route::middleware(['auth:sanctum', 'admin'])->post(
    '/transaction/bayar/{id}',
    [TransactionController::class, 'bayar']
);
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/transaction/cancel/{id}',
    [TransactionController::class, 'cancel']
);
Route::middleware(['auth:sanctum', 'admin'])->get(
    '/transaction',
    [TransactionController::class, 'index']
);
Route::get('/pesanan/baru', [PesananController::class, 'create']);
Route::post('/pesanan/baru', [PesananController::class, 'store']);
