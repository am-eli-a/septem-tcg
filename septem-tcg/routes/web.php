<?php

use App\Actions\OpenBooster;
use App\Models\Card;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('booster', function () {
        abort_unless(auth()->user()->isMember(), 403);

        return view('booster', [
            'next' => auth()->user()->nextBoosterAt(),
        ]);
    })->name('booster');

    Route::post('booster', function () {
        abort_unless(auth()->user()->isMember(), 403);

        try {
            $cards = (new OpenBooster)->handle(auth()->user());
        } catch (\RuntimeException $e) {
            return back()->withErrors(['booster' => $e->getMessage()]);
        }

        return view('booster', [
            'cards' => $cards,
            'next' => auth()->user()->nextBoosterAt(),
        ]);
    });
});

Route::get('galerie', function () {
    $cards = Card::visibleTo(null)->orderBy('number')->get();

    return view('galerie', ['cards' => $cards]);
})->name('galerie');

Route::get('cartes/{card}/image', function (Card $card) {
    abort_unless(Card::visibleTo(auth()->user())->whereKey($card->id)->exists(), 404);

    return Storage::disk($card->visibility === 'public' ? 'public' : 'local')
        ->response($card->path);
})->name('cards.image');

require __DIR__.'/settings.php';
