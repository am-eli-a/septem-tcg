<x-layouts.site>
    <x-slot:title>Galerie</x-slot:title>
    <div>
        <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">La galerie</h1>

        @if (auth()->user()?->isMember())
            <p class="text-muted">Les personnages des courts métrages et les cartes refs, ouverts à tous les membres de l'association</p>
        @else
            <p class="text-muted">Les personnages des courts métrages, ouverts à tous les visiteurs</p>
        @endif
    </div>

    <section class="mt-15">
        <h2 class="font-display uppercase text-xl md:text-4xl">Cartes publiques</h2>
        <div class="grid gap-4 grid-cols-[repeat(auto-fill,minmax(130px,1fr))] md:grid-cols-[repeat(auto-fill,minmax(160px,1fr))]">
            @forelse($cards->where('visibility', 'public') as $card)
                <div class="relative grid gap-4 mt-8">
                    <p class="absolute left-2 top-2 rounded-full font-bold bg-[#0A0B0A95] text-white font-display px-3 py-1">N° {{ $card->number }}</p>
                    <img src="{{ route('cards.image', $card) }}" alt="{{ $card->title }}" class="rounded-2xl w-full h-auto">
                </div>
            @empty
                <p>Aucune carte pour l'instant</p>
           @endforelse
        </div>
    </section>

    @if (auth()->user()?->isMember())
    <section class="mt-10">
        <h2 class="font-display uppercase text-xl md:text-4xl">Cartes membres</h2>
        <div class="grid gap-4 grid-cols-[repeat(auto-fill,minmax(130px,1fr))] md:grid-cols-[repeat(auto-fill,minmax(160px,1fr))]">
            @forelse ($cards->where('visibility', 'internal') as $card)
                <div class="relative grid gap-4 mt-8">
                    <p class="absolute left-2 top-2 rounded-full font-bold bg-[#0A0B0A95] text-white font-display px-3 py-1">N° {{ $card->number }}</p>
                    <img src="{{ route('cards.image', $card) }}" alt="{{ $card->title }}" class="rounded-2xl w-full h-auto">
                </div>
            @empty
                <p>Aucune carte pour l'instant.</p>
           @endforelse
        </div>
    </section>
    @endif

</x-layouts.site>
