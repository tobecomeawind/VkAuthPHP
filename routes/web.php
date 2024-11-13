<?php

use Illuminate\Support\Facades\Route;



Route::get('login', function () {
	return view('log');
})->name('LoginPage');

/*
Route::get('vkAuth', function () {
	return redirect('https://id.vk.com/authorize');
})->name('VkAuth');
*/

Route::get('/', function () {
    return redirect()->route('LoginPage');
});


