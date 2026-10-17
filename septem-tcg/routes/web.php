<?php

use Illuminate\Support\Facades\Route;
use App\Models\Card;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});


Route::get('galerie', function () {
    $cards = Card::VisibleTo(null)->orderBy('number')->get();

    return view('galerie', ['cards' => $cards]);
})->name('galerie');

require __DIR__.'/settings.php';
