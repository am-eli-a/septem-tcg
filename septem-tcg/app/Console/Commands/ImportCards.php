<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

#[Signature('cards:import')]
#[Description('Importe les cartes du dossier storage/app/private/cards')]
class ImportCards extends Command
{
    public function handle()
    {
        $rarities = [
            'commun' => 'common',
            'rare' => 'rare',
            'epic' => 'epic',
            'légendaire' => 'legendary',
            'ultimate' => 'unique',
        ];

        $prefixOf = fn ($file) => mb_strtolower(
            explode(' (', pathinfo($file, PATHINFO_FILENAME))[0]
        );

        $order = array_keys($rarities);

        $sources = [
            ['disk' => 'public', 'dir' => 'characters', 'type' => 'character', 'visibility' => 'public'],
            ['disk' => 'local',  'dir' => 'cards',      'type' => 'member',    'visibility' => 'internal'],
        ];

        Card::query()->delete();

        $user = User::first();
        $number = 1;

        foreach ($sources as $source) {
            $files = Storage::disk($source['disk'])->files($source['dir']);
            usort($files, function ($a, $b) use ($prefixOf, $order) {
                $byRarity = array_search($prefixOf($a), $order) <=> array_search($prefixOf($b), $order);

                return $byRarity !== 0
                    ? $byRarity
                    : strnatcasecmp(
                        pathinfo($a, PATHINFO_FILENAME),
                        pathinfo($b, PATHINFO_FILENAME)
                    );
            });

            foreach ($files as $file) {
                Card::forceCreate([
                    'title' => pathinfo($file, PATHINFO_FILENAME),
                    'path' => $file,
                    'type' => $source['type'],
                    'visibility' => $source['visibility'],
                    'status' => 'approved',
                    'rarity' => $rarities[$prefixOf($file)],
                    'number' => $number,
                    'uploaded_by' => $user->id,
                ]);

                $number++;
            }
        }

        $this->info(($number - 1).' cartes importées');
    }
}
