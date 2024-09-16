<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd('ebeng');
    return view('welcome');
});
