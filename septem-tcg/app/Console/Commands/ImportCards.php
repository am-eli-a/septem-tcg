<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

#[Signature('cards:import')]
#[Description('Importe les nouvelles cartes des dossiers de stockage, sans toucher aux existantes')]
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

        $user = User::first();

        if (! $user) {
            $this->error('Aucun utilisateur trouvé : crée un compte avant d\'importer.');

            return;
        }

        $known = Card::pluck('path')->all();
        $number = (int) Card::max('number');
        $created = 0;

        foreach ($sources as $source) {
            $files = array_filter(
                Storage::disk($source['disk'])->files($source['dir']),
                fn ($file) => in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['png', 'jpg', 'jpeg', 'webp'])
                    && ! in_array($file, $known)
            );

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
                $rarity = $rarities[$prefixOf($file)] ?? null;

                if (! $rarity) {
                    $this->warn("Rareté inconnue, ignoré : {$file}");

                    continue;
                }

                $number++;

                Card::forceCreate([
                    'title' => pathinfo($file, PATHINFO_FILENAME),
                    'path' => $file,
                    'type' => $source['type'],
                    'visibility' => $source['visibility'],
                    'status' => 'approved',
                    'rarity' => $rarity,
                    'number' => $number,
                    'uploaded_by' => $user->id,
                ]);

                $created++;
            }
        }

        $this->info("{$created} nouvelle(s) carte(s) importée(s)");
    }
}
