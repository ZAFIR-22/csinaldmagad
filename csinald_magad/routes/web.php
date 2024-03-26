<?php

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
    return view('welcome');
});
Route::get('/keszitmenyek', function () {
    return view('keszitmenyek');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/account', function () {
    return view('Account');
});
Route::get('/logout', function () {
    return view('logout');
});
Route::get('/creationdetail', function () {
    return view('creation_details');
});
Route::get('/feltolt', function () {
    return view('feltolt');
});
Route::get('/creationdetailaccount', function () {
    return view('creation_details_account');
});
Route::get('/savedcreations', function () {
    return view('savedcreation');
});
Route::get('/creationdetailsaved', function () {
    return view('creation_detail_saved');
});