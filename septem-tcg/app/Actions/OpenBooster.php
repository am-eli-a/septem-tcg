<?php
namespace App\Actions;
use App\Models\User;
use App\Models\Card;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class OpenBooster {

    private function pickRarity(): string {
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
        return "common";
    }

    private function pickCard(User $user, string $rarity): ?Card
    {
        $query = Card::visibleTo($user)->where('status', 'approved')->where('rarity', $rarity);
        return $query->inRandomOrder()->first();
    }
    public function handle(User $user): Collection
    {
        return DB::transaction(function () use ($user) {
            $cards = collect();
            for ($i = 0; $i < config('booster.size'); $i++) {
                $card = $this->pickCard($user, $this->pickRarity())
                    ?? $this->pickCard($user, 'common');

                if ($card) {
                    $owned = $user->cards()->find($card->id);
                    if ($owned) {
                        $user->cards()->updateExistingPivot($card->id, ['quantity' => ($owned->pivot->quantity) + 1]);
                    } else {
                        $user->cards()->attach($card->id, ['quantity' => 1]);
                    }
                    $cards->push($card);
                }
            };
            return $cards;
        });
    }
}
