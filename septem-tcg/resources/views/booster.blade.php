<x-layouts.site>
    <x-slot:title>Booster</x-slot:title>

    <div class="flex flex-wrap items-end justify-between gap-4">
        <div class="flex flex-col gap-2">
            @isset($cards)
                <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">Ton booster</h1>
                <p class="text-muted">Clique sur une carte pour la retourner.</p>
            @else
                <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">Ouvrir un booster</h1>
                <p class="text-muted max-w-xl">Cinq cartes tirées au hasard parmi celles que tu peux voir. Plus la rareté est haute, plus elle est difficile à croiser.</p>
            @endisset
        </div>

        <p class="inline-flex items-center gap-2 rounded-full bg-card border border-white/10 px-4 py-2 font-medium">
            <span @class(['w-2.5 h-2.5 rounded-full', 'bg-gray-400' => $next, 'bg-green-400' => ! $next])></span>
            @if ($next)
                Prochain booster : {{ $next->diffForHumans() }}
            @else
                Booster disponible maintenant
            @endif
        </p>
    </div>

    @error('booster')
    <p class="mt-6 text-red-400">{{ $message }}</p>
    @enderror

    @isset($cards)
        <div class="mt-10 grid gap-5 grid-cols-[repeat(auto-fit,minmax(170px,1fr))]">
            @foreach ($cards as $card)
                @php $qty = auth()->user()->cards()->find($card->id)?->pivot->quantity; @endphp
                <button type="button" data-flip aria-label="Carte face cachée, clique pour la retourner"
                        class="card-flip block w-full aspect-[1240/1754] cursor-pointer">
                    <div class="card-flip-inner">
                        <div class="card-face card-back">
                            <img src="{{ asset('storage/logo/Logo_FNpng.png') }}" alt="" class="w-3/4 h-auto">
                        </div>
                        <div class="card-face card-front">
                            <img src="{{ route('cards.image', $card) }}" alt="{{ $card->title }}"
                                 class="w-full h-full rounded-xl shadow-2xl">
                            <span class="absolute right-2.5 top-2.5 rounded-full bg-gold text-ink font-display px-3 py-1">
                                {{ $qty > 1 ? 'x'.$qty : 'NEW' }}
                            </span>
                        </div>
                    </div>
                </button>
            @endforeach
        </div>

        <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
            <button type="button" id="reveal-all"
                    class="rounded-full border-2 border-white/30 px-8 py-3 font-bold cursor-pointer hover:border-gold">
                Tout révéler
            </button>
            <a href="{{ route('collection') }}"
               class="inline-block rounded-full bg-gold text-ink font-bold px-8 py-3">
                Voir ma collection
            </a>
        </div>
    @else
        <div class="mt-10 flex flex-col items-center gap-9">
            <img src="{{ asset('storage/layouts/sleeve.png') }}" alt="Pochette de booster"
                @class(['w-70 h-auto rounded-lg', 'opacity-50' => $next])>

            @if ($next)
                <button disabled class="rounded-full bg-gold text-ink font-bold px-10 py-4 opacity-50">
                    Ouvrir mon booster
                </button>
            @else
                <form method="POST" action="{{ route('booster') }}">
                    @csrf
                    <button type="submit" class="rounded-full bg-gold text-ink font-bold px-10 py-4 cursor-pointer">
                        Ouvrir mon booster
                    </button>
                </form>
            @endif
        </div>
    @endisset
</x-layouts.site>
