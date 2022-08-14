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

Route::get('/',function () {
    return view('home',[
        'upcoming_events' => \App\Models\Event::query()->where("is_signup_open", "=", "1")->get()
    ]);
});

Route::get("login",\App\Http\Controllers\DiscordRedirectController::class)->name("login");
Route::get("logout",[DiscordLoginController::class,"logout"])->name("logout");
Route::get("/login/discord-callback",[DiscordLoginController::class,"authenticate"]);

Route::resource("characters",\App\Http\Controllers\CharacterController::class)
    ->except(['show'])
    ->middleware('auth');

Route::resource("events",\App\Http\Controllers\EventController::class)
    ->middleware('can:manage-discord');

Route::resource("events.occurrences",\App\Http\Controllers\EventOccurrenceController::class)
    ->middleware('can:manage-discord');

Route::post("/events/occurrences/{id}/register", [\App\Http\Controllers\EventOccurrenceController::class,"signup"]);
