<?php

use App\Actions\OpenBooster;
use App\Http\Controllers\ProfileController;
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

    Route::get('profil', [ProfileController::class, 'show'])->name('profil');
    Route::get('profil-edit', [ProfileController::class, 'edit'])->name('profil-edit');

    Route::delete('profil', [ProfileController::class, 'destroy'])->name('profil.destroy');

    Route::put('profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::put('profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');
});

Route::middleware(['auth', 'validator'])->group(function () {
    Route::get('validator/dashboard', function () {
        return view('validation', []);
    })->name('validator.dashboard');
});

Route::get('galerie', function () {
    $cards = Card::visibleTo(auth()->user())->orderBy('number')->get();
    return view('galerie', ['cards' => $cards]);
})->name('galerie');

Route::get('cartes/{card}/image', function (Card $card) {
    abort_unless(Card::visibleTo(auth()->user())->whereKey($card->id)->exists(), 404);

    return Storage::disk($card->visibility === 'public' ? 'public' : 'local')
        ->response($card->path);
})->name('cards.image');

require __DIR__.'/settings.php';
