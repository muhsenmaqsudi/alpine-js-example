<?php

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
})->name('home');

Route::get('/features', function () {
    $cities = \App\City::where('parent_id', null)->get();
    return view('features', compact('cities'));
})->name('features');

Route::get('/cities/{id}', function (\Illuminate\Http\Request $request, $id) {
    $cities = \App\City::where('parent_id', $id)->get();
    return $cities->toJson();
});
