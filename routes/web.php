<?php

use App\Http\Controllers\DiscordLoginController;
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

Route::get('/', function () {
    return view('home');
});

Route::get("login",\App\Http\Controllers\DiscordRedirectController::class)->name("login");
Route::post("logout",[DiscordLoginController::class,"logout"])->name("logout");
Route::get("/login/discord-callback", [DiscordLoginController::class,"authenticate"]);

Route::resource("character",\App\Http\Controllers\CharacterController::class)
->only(['index', 'edit', 'update', 'create', 'store', 'destroy'])
->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
