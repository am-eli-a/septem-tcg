@php
    $rarities = [
        'common' => ['Commun', 'Commun.png'],
        'rare' => ['Rare', 'Rare.png'],
        'epic' => ['Epic', 'Epic.png'],
        'legendary' => ['Légendaire', 'Legendaire.png'],
        'unique' => ['Unique', 'Unique.png'],
    ];
@endphp

<x-layouts.site>
    <x-slot:title>Septem TCG</x-slot:title>

    <section class="mt-8 mb-16 md:mt-15 md:mb-30 grid gap-10 md:grid-cols-2 items-center">
        <div>
            <p class="uppercase text-xs text-gold mb-5">Cartes à collectionner - Septem 24</p>
            <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">
                Ouvre ton <br> booster.
                <span class="block mt-2">Complète la <br> collection.</span>
            </h1>
            <p class="my-5 text-muted max-w-md">Les personnages des courts métrages et les visages de l'association, réunis en cartes. Cinq cartes par booster, complète la collection.</p>

            <div class="flex flex-wrap gap-3 mb-6">
                <a href="{{ route('register') }}" class="inline-block rounded-full bg-gold text-ink font-bold px-8 py-3">Créer un compte</a>
                <a href="{{ route('galerie') }}" class="inline-block rounded-full border-2 border-white/30 hover:border-gold font-bold px-8 py-3">Voir la galerie</a>
            </div>
            <p class="text-muted text-sm">Ouvrir des boosters est réservé aux membres validés de Septem 24</p>
        </div>

        <div class="flex justify-center items-center -space-x-8 md:-space-x-10">
            @foreach ($cards->take(3) as $card)
                <img src="{{ asset('storage/'.$card->path) }}" alt="{{ $card->title }}"
                    @class([
                        'w-28 sm:w-36 md:w-40 h-auto rounded-xl shadow-2xl',
                        '-rotate-6' => $loop->first,
                        'z-10 scale-110' => $loop->iteration === 2,
                        'rotate-6' => $loop->last,
                    ])>
            @endforeach
        </div>
    </section>

    <section class="my-16 md:my-30">
        <h2 class="font-display uppercase text-4xl md:text-6xl leading-none">Cinq raretés</h2>
        <p class="text-muted mt-2 max-w-xl">Chaque carte a sa rareté, donc sa chance de sortir d'un booster. La carte unique est la plus difficile à croiser.</p>

        <div class="grid grid-cols-6 md:grid-cols-5 gap-4 md:gap-10 mt-8">
            @foreach (config('booster.weights') as $key => $weight)
                <div @class([
                    'col-span-2 md:col-span-1',
                    'col-start-2 md:col-start-auto' => $loop->iteration === 4,
                ])>
                    <img src="{{ asset('storage/layouts/'.$rarities[$key][1]) }}" alt="{{ $rarities[$key][0] }}" class="rounded-2xl w-full h-auto mb-4">
                    <h3 class="font-display uppercase text-xl mb-1">{{ $rarities[$key][0] }}</h3>
                    <p class="text-muted text-sm">{{ $weight }} % de chances</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="my-16 md:my-30">
        <h2 class="font-display uppercase text-4xl md:text-6xl leading-none">Comment ça marche</h2>
        <div class="flex flex-wrap justify-center gap-6 md:gap-10 mt-10">
            <div class="bg-card p-6 rounded-2xl flex-1 basis-[260px] max-w-sm">
                <p class="font-display text-4xl md:text-6xl leading-none text-gold">01</p>
                <h3 class="font-bold text-xl my-4">Crée ton compte</h3>
                <p class="text-muted">Inscris-toi en quelques secondes. Tu peux déjà parcourir la galerie des personnages.</p>
            </div>
            <div class="bg-card p-6 rounded-2xl flex-1 basis-[260px] max-w-sm">
                <p class="font-display text-4xl md:text-6xl leading-none text-gold">02</p>
                <h3 class="font-bold text-xl my-4">Fais valider ton compte</h3>
                <p class="text-muted">Envoie-moi un message avec ton mail sur insta (@amelia.dlzr) et je t'ouvre l'accès aux boosters.</p>
            </div>
            <div class="bg-card p-6 rounded-2xl flex-1 basis-[260px] max-w-sm">
                <p class="font-display text-4xl md:text-6xl leading-none text-gold">03</p>
                <h3 class="font-bold text-xl my-4">Ouvre des boosters</h3>
                <p class="text-muted">Cinq cartes à chaque ouverture, toutes les 5 heures. Ta collection se remplit, les trous te montrent ce qu'il manque.</p>
            </div>
        </div>
    </section>

    <section class="mb-16 md:mb-30">
        <h2 class="font-display uppercase text-4xl md:text-6xl leading-none">La galerie</h2>
        <p class="text-muted mt-2">Les personnages des courts métrages, ouverts à tous les visiteurs</p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            @foreach ($cards as $card)
                <img src="{{ asset('storage/'.$card->path) }}" alt="{{ $card->title }}" class="rounded-2xl w-full h-auto">
            @endforeach
        </div>

        <a href="{{ route('galerie') }}" class="inline-block text-gold font-bold mt-6">Voir toute la galerie →</a>
    </section>

    <section class="mb-8 rounded-2xl bg-gold text-ink p-6 md:p-10 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="font-display uppercase text-2xl md:text-4xl leading-none">Tu fais partie de Septem 24 ?</h2>
            <p class="mt-2">Fais valider ton compte pour ouvrir des boosters et débloquer les cartes des membres.</p>
        </div>
        <a href="{{ route('register') }}" class="inline-block rounded-full bg-ink text-cream font-bold px-8 py-3">Créer un compte</a>
    </section>
</x-layouts.site>
