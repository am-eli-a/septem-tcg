<x-layouts.site>
    <h1>Ma collection</h1>

    <p>
        {{ $slots->whereNotNull('quantity')->count() }} / {{ $slots->count() }}
        ·
        {{ $slots->where('quantity', '>', 1)->sum(fn ($s) => $s->quantity - 1) }} doublons
    </p>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 16px;">
        @foreach ($slots as $slot)
            @if ($slot->quantity)
                <div>
                    <img src="{{ route('cards.image', $slot) }}" alt="{{ $slot->title }}" width="150">
                    <p>N° {{ $slot->number }}</p>
                    @if ($slot->quantity > 1)
                        <p>x{{ $slot->quantity }}</p>
                    @endif
                </div>
            @else
                <div>
                    <p>N° {{ $slot->number }}</p>
                    <p>Manquante</p>
                </div>
            @endif
        @endforeach
    </div>
</x-layouts.site>
