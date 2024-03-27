<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {

    //Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //items route
    Route::get('/import-items', [ItemController::class, 'importIndex'])->name('items.import.index');
    Route::post('/import-items', [ItemController::class, 'import'])->name('items.import');
    // Route::post('/items/return', 'InventoryController@returnItem');
    Route::resource('items', ItemController::class);

    //Clients route
    Route::resource('clients', ClientController::class);

    //Users route
    Route::put('/users/{userId}/update-password', [UserController::class, 'updatePassword'])->name('users.password.update');
    Route::resource('users', UserController::class);


    //Checkout route
    Route::post('checkouts/{checkout}/return-to-stock', [CheckoutController::class, 'returnToStock'])->name('return_to_stock');
    Route::resource('checkouts', CheckoutController::class);

    //Report route
    Route::resource('reports', ReportController::class);



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
