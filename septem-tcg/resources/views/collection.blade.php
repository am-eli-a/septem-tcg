<x-layouts.site>
    <x-slot:title>Collection</x-slot:title>
    <div class="flex justify-between flex-wrap items-end gap-3 md:gap-7">
        <div class="flex flex-col gap-3">
            <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">Ma collection</h1>
            <p class="text-muted md:mb-10 mb-5">Les cases sont vides quand la carte n'a pas été encore obtenue.</p>
        </div>

        <div class="flex flex-col gap-2 w-full md:w-96">
            <div class="flex items-end justify-between">
                <p class="font-display text-4xl md:text-6xl leading-none"> <span class="text-gold">{{ $slots->whereNotNull('quantity')->count() }}</span> / {{ $slots->count() }} </p>
                <p class="text-muted">{{ $slots->where('quantity', '>', 1)->sum(fn ($s) => $s->quantity - 1) }} doublons </p>
            </div>
            @php
                $owned = $slots->whereNotNull('quantity')->count();
                $collection = $slots->count();
                $pct = round($owned/$collection * 100);
            @endphp
            <div class="flex items-center gap-3 h-2.5 rounded-full bg-[#1E211E] overflow-hidden">
                <div class="h-full rounded-full bg-gold" style="width: {{ $pct }}%"></div>
            </div>
            <p class="text-muted mb-5"> {{ $pct }} % de la collection complétée</p>
        </div>
    </div>

    <div class="grid gap-4 grid-cols-[repeat(auto-fill,minmax(130px,1fr))] md:grid-cols-[repeat(auto-fill,minmax(160px,1fr))]">
        @foreach ($slots as $slot)
            @if ($slot->quantity)
                <div class="relative">
                    <img src="{{ route('cards.image', $slot) }}" alt="{{ $slot->title }}" width="150" class="rounded-2xl w-full h-auto">
                    <p class="absolute left-2 top-2 rounded-full text-s font-bold bg-[#0A0B0A95] text-white font-display px-3 py-1">N° {{ $slot->number }}</p>
                    @if ($slot->quantity > 1)
                        <span class="absolute right-1 bottom-2 rounded-full md:text-xl text-x font-bold bg-gold text-ink font-display px-4 py-1">
                                x{{ $slot->quantity }}
                        </span>
                    @endif
                </div>
            @else
                <div class="aspect-[1240/1754] w-full border-2 border-dashed border-white/20 rounded-xl bg-card text-center content-center">
                    <p class="font-display text-4xl text-muted">{{ $slot->number }}</p>
                    <p class="text-xs uppercase tracking-widest">Manquante</p>
                </div>
            @endif
        @endforeach
    </div>
</x-layouts.site>
