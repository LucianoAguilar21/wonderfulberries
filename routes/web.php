<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PalletController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VarietyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders',[OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders/show/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/pallets/edit/{pallet}',[PalletController::class,'edit'])->name('pallets.edit');
    Route::put('/pallets/update/{pallet}',[PalletController::class,'update'])->name('pallets.update');

    Route::get('/orders/edit/{order}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/pallets', [PalletController::class, 'store'])->name('pallets.store');
    Route::put('/orders/update/{order}',[OrderController::class, 'update'])->name('orders.update');

    Route::delete('/pallets/{pallet}', [PalletController::class, 'destroy'])->name('pallets.delete');

    Route::get('/orders/{order}/copy-info', [OrderController::class, 'copyInfo'])->name('orders.copyInfo');

    Route::view('admin','admin.index')->name('admin.index');

    Route::get('/admin/clients', [ClientController::class, 'index'])->name('admin.clients.index');
    Route::get('/admin/clients/show/{client}', [ClientController::class, 'show'])->name('admin.clients.show');
    Route::get('/admin/clients/create', [ClientController::class, 'create'])->name('admin.clients.create');
    Route::get('/admin/clients/edit/{client}', [ClientController::class, 'edit'])->name('admin.clients.edit');
    Route::post('/admin/clients', [ClientController::class, 'store'])->name('admin.clients.store');
    Route::put('/admin/clients/update/{client}', [ClientController::class, 'update'])->name('admin.clients.update');
    Route::delete('/admin/clients/delete/{client}', [ClientController::class, 'destroy'])->name('admin.clients.destroy');


    Route::get('admin/varieties',[VarietyController::class,'index'])->name('admin.varieties.index');
    Route::get('admin/varieties/show/{variety}',[VarietyController::class,'show'])->name('admin.varieties.show');
    Route::get('admin/varieties/create',[VarietyController::class,'create'])->name('admin.varieties.create');
    Route::get('admin/varieties/edit/{variety}',[VarietyController::class,'edit'])->name('admin.varieties.edit');
    Route::post('admin/varieties',[VarietyController::class,'store'])->name('admin.varieties.store');
    Route::put('admin/varieties/update/{variety}',[VarietyController::class,'update'])->name('admin.varieties.update');
    Route::delete('admin/varieties/delete/{variety}',[VarietyController::class,'destroy'])->name('admin.varieties.destroy');

    Route::get('admin/fields/create',[VarietyController::class,'create'])->name('admin.fields.create');
});

require __DIR__.'/auth.php';
