<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PositionController;


/*Route::get('/', function () {
    return view('welcome');
});*/

// Site (frontend)
Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/staff', [SiteController::class, 'staff'])->name('site.staff');
Route::get('/positions', [SiteController::class, 'positions'])->name('site.positions');

// Peoples (edit data)
Route::group(['prefix' => 'staff'], function () {
    Route::get('/create', [StaffController::class, 'staffCreate'])->name('staff.create');
    Route::post('/store', [StaffController::class, 'staffStore'])->name('staff.store');
    Route::get('/edit/{id}', [StaffController::class, 'staffEditForm'])->name('staff.edit.form');
    Route::post('/edit/{id}', [StaffController::class, 'staffUpdate'])->name('post.staff.update');
    Route::delete('/delete/{id}', [StaffController::class, 'staffDestroy'])->name('staff.delete');
});

// Positions (edit data)
Route::resource('positions', PositionController::class)->except([
    'index', 'show'
]);
