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
    $cities = [
        [
            "id" => 1,
            "name" => "Tehran"
        ],
        [
            "id" => 2,
            "name" => "Alborz"
        ]];

    return view('features', compact('cities'));
})->name('features');

Route::get('/cities/{id}', function (\Illuminate\Http\Request $request, $id) {
    $AllCities = [
        [
            "id" => 1,
            "city_id" => 1,
            "name" => "Tehran"
        ],
        [
            "id" => 2,
            "city_id" => 1,
            "name" => "Eslamshahr"
        ],
        [
            "id" => 3,
            "city_id" => 2,
            "name" => "Karaj"
        ],
        [
            "id" => 4,
            "city_id" => 2,
            "name" => "Mehrshahr"
        ],
    ];

    $selectedCity = \Illuminate\Support\Arr::where($AllCities, function ($value, $key) use ($id) {
        return $value['city_id'] == $id;
    });

    $selectedCity = json_encode($selectedCity);

    return response($selectedCity, '200');
});
