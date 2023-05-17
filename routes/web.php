<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\PropertyController;
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

Auth::routes();

Route::get('/', [PropertyController::class, 'index'])->name('index');
Route::get('/property/{id}/show', [PropertyController::class, 'show'])->name('property.show');

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'property', 'as' => 'property.'], function(){
        Route::get('/create', [PropertyController::class, 'create'])->name('create');
        Route::post('/store', [PropertyController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PropertyController::class, 'edit'])->name('edit');
        Route::patch('/{id}/update', [PropertyController::class, 'update'])->name('update');
        Route::delete('{id}/destroy', [PropertyController::class, 'destroy'])->name('destroy');
    });

});