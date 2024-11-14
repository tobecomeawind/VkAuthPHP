<?php

use App\Http\Controllers\LoginPageController;

use Illuminate\Support\Facades\Route;



Route::get('/', [LoginPageController::class, 'showLoginPage'])
	->name('LoginPage');

/*
Route::get('vkAuth', function () {
	return redirect('https://id.vk.com/authorize');
})->name('VkAuth');
*/

/*
Route::get('/', function () {
    return redirect()->route('LoginPage');
});
 */

