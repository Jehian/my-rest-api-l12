<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/product', function () {
    return view('pages.plp');
})->name('plp');

Route::get('/details/{i}', function () {
    return view('pages.pdp');
})->name('pdp');


