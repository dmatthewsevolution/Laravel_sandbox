<?php

use App\Http\Controllers\SettingsController;
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

Route::view('/', 'welcome')->name('home');
Route::view('/settings', 'settings')->name('settings');
Route::post('/settings', [SettingsController::class, 'settings_post'])->name('settings_post');

Route::prefix('test')->group(function () {
    Route::view('/path1', 'settings');
    Route::view('/path2', 'settings');
    Route::view('/path3', 'settings');
});
