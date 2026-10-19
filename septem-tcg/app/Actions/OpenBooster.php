<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Card;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OpenBooster
{
    private function pickRarity(): string
    {
        $weights = config('booster.weights');
        $total = array_sum($weights);
        $roll = random_int(1, $total);

        $cumul = 0;
        foreach ($weights as $rarity => $weight) {
            $cumul += $weight;
            if ($roll <= $cumul) {
                return $rarity;
            }
        }
        return 'common';
    }

    private function pickCard(User $user, string $rarity): ?Card
    {
        return Card::visibleTo($user)
            ->where('status', 'approved')
            ->where('rarity', $rarity)
            ->inRandomOrder()
            ->first();
    }

    public function handle(User $user): Collection
    {
        return DB::transaction(function () use ($user) {

            if ($user->last_booster_at) {
                $fin = $user->last_booster_at->copy()->addHours(config('booster.cooldown_hours'));

                if ($fin->isFuture()) {
                    throw new \RuntimeException('Prochain booster ' . $fin->diffForHumans());
                }
            }

            $cards = collect();
            for ($i = 0; $i < config('booster.size'); $i++) {
                $card = $this->pickCard($user, $this->pickRarity())
                    ?? $this->pickCard($user, 'common');

                if ($card) {
                    $owned = $user->cards()->find($card->id);
                    if ($owned) {
                        $user->cards()->updateExistingPivot($card->id, ['quantity' => $owned->pivot->quantity + 1]);
                    } else {
                        $user->cards()->attach($card->id, ['quantity' => 1]);
                    }
                    $cards->push($card);
                }
            }

            $user->forceFill(['last_booster_at' => now()])->save();

            return $cards;
        });
    }
}
