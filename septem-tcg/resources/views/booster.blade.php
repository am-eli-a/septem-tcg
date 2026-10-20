<x-layouts.site>
    <h1 class="font-display uppercase text-4xl">Ton booster</h1>

    @if ($next)
        <p class="rounded-full bg-card border-white/10">Ton booster {{ $next->diffForHumans() }}</p>
    @else
        <form method="POST" action="{{ route('booster') }}">
            @csrf
            <button type="submit" class="bg-gold text-ink font-bold px-10 py-4 rounded-full">Ouvrir mon booster</button>
        </form>
    @endif

    @error('booster')
    <p>{{ $message }}</p>
    @enderror

    @isset($cards)
        <div class="flex max-w-200 py-10">
            @foreach ($cards as $card)
                <img src="{{ route('cards.image', $card) }}" alt="{{ $card->title }}" width="200" class="rounded-ld justify-around">
            @endforeach
        </div>
    @endisset
</x-layouts.site>
