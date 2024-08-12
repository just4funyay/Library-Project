<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BorrowController;

Route::get('/', function () {
    return view('auth.register');
});


Route::get('/borrow', [BorrowController::class, 'create'])->name('borrow.create');
Route::post('/borrow', [BorrowController::class, 'store'])->name('borrow.store');
Route::get('/my-books', [BorrowController::class, 'myBooks'])->name('borrow.my-books');
Route::put('/borrow/{id}/return', [BorrowController::class, 'return'])->name('borrow.return');
Route::get('/books/{id}', [BorrowController::class, 'show'])->name('borrow.show');

//general users
Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', [ProfileController::class, 'edit'])->name('profile.edit');
});
Route::get('/dashboard', [BorrowController::class, 'dashboard'])->middleware('auth')->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//admin
Route::middleware(['auth','admin'])->group(function (){
    Route::get('admin/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
    Route::get('admin/dashboard/export',[HomeController::class,'index'])->name('admin.export');
    Route::get('admin/dashboard/create',[HomeController::class,'create'])->name('admin.create');
    Route::post('admin/dashboard',[HomeController::class,'store'])->name('admin.store');
    Route::get('admin/dashboard/{book}/update',[HomeController::class,'edit'])->name('admin.edit');
    Route::put('admin/dashboard/{book}',[HomeController::class,'update'])->name('admin.update');    
    Route::delete('admin/dashboard/{book}',[HomeController::class,'destroy'])->name('admin.destroy'); 
});

