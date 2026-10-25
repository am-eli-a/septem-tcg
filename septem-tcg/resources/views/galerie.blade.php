<x-layouts.site>
    <x-slot:title>Galerie</x-slot:title>
    <div>
        <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">La galerie</h1>
        <p class="text-muted">Les personnages des courts métrages, ouverts à tous les visiteurs</p>
    </div>
    <div class="grid gap-4 grid-cols-[repeat(auto-fill,minmax(130px,1fr))] md:grid-cols-[repeat(auto-fill,minmax(160px,1fr))]">
        @forelse ($cards as $card)
            <div class="relative grid gap-4 mt-8">
                <p class="absolute left-2 top-2 rounded-full font-bold bg-[#0A0B0A95] text-white font-display px-3 py-1">N° {{ $card->number }}</p>
                <img src="{{ asset('storage/'.$card->path) }}" alt="{{ $card->title }}" class="rounded-2xl w-full h-auto">
            </div>
        @empty
            <p>Aucune carte pour l'instant.</p>
       @endforelse
    </div>
</x-layouts.site>
