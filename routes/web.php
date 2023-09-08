<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\PlaceController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Members------------------------
Route::get('/members', [MemberController::class , 'index'])->name('members.index');
Route::get('/members/show/{id}' ,[MemberController::class , 'show'] )->name('members.show');
Route::get('/members/create' ,[MemberController::class , 'create'] )->name('members.create');
Route::post('/members/store' ,[MemberController::class , 'store'] )->name('members.store');
Route::get('/members/edit/{id}' ,[MemberController::class , 'edit'] )->name('members.edit');
Route::post('/members/update/{id}' ,[MemberController::class , 'update'] )->name('members.update');
Route::get('/members/delete/{id}',[MemberController::class , 'delete'])->name('members.delete');
// Alerts------------------------
Route::get('/alerts', [AlertController::class , 'index'])->name('alerts.index');
Route::get('/alerts/show/{id}' ,[AlertController::class , 'show'] )->name('alerts.show');
Route::get('/alerts/create' ,[AlertController::class , 'create'] )->name('alerts.create');
Route::post('/alerts/store' ,[AlertController::class , 'store'] )->name('alerts.store');
Route::get('/alerts/edit/{id}' ,[AlertController::class , 'edit'] )->name('alerts.edit');
Route::post('/alerts/update/{id}' ,[AlertController::class , 'update'] )->name('alerts.update');
Route::get('/alerts/delete/{id}',[AlertController::class , 'delete'])->name('alerts.delete');
// Places------------------------
Route::get('/places', [PlaceController::class , 'index'])->name('places.index');
Route::get('/places/show/{id}' ,[PlaceController::class , 'show'] )->name('places.show');
Route::get('/places/create' ,[PlaceController::class , 'create'] )->name('places.create');
Route::post('/places/store' ,[PlaceController::class , 'store'] )->name('places.store');
Route::get('/places/edit/{id}' ,[PlaceController::class , 'edit'] )->name('places.edit');
Route::post('/places/update/{id}' ,[PlaceController::class , 'update'] )->name('places.update');
Route::get('/places/delete/{id}',[PlaceController::class , 'delete'])->name('places.delete');