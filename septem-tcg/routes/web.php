<?php

use App\Actions\OpenBooster;
use App\Models\Card;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome', [
        'cards' => Card::visibleTo(null)->inRandomOrder()->limit(4)->get(),
    ]);
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('en-attente', function () {
    if (auth()->user()->isMember()) {
        return redirect()->route('booster');
    }

    return view('pending');
})->middleware('auth')->name('pending');

Route::middleware(['auth', 'member'])->group(function () {

    Route::get('booster', function () {
        return view('booster', [
            'next' => auth()->user()->nextBoosterAt(),
        ]);
    })->name('booster');

    Route::post('booster', function () {
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

    Route::get('collection', function () {
        $user = auth()->user();

        $slots = Card::visibleTo($user)
            ->leftJoin('user_cards', function ($join) use ($user) {
                $join->on('cards.id', '=', 'user_cards.card_id')
                    ->where('user_cards.user_id', $user->id);
            })
            ->select('cards.*', 'user_cards.quantity')
            ->orderBy('cards.number')
            ->get();

        return view('collection', ['slots' => $slots]);
    })->name('collection');
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
