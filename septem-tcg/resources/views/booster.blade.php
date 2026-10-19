<h1>Page booster</h1>

@if ($next)
    <p>Prochain booster {{ $next->diffForHumans() }}</p>
    <button disabled>Ouvrir mon booster</button>
@else
    <form method="POST" action="{{ route('booster') }}">
        @csrf
        <button type="submit">Ouvrir mon booster</button>
    </form>
@endif

@error('booster')
<p>{{ $message }}</p>
@enderror

@isset($cards)
    <div>
        @foreach ($cards as $card)
            <img src="{{ route('cards.image', $card) }}" alt="{{ $card->title }}" width="200">
        @endforeach
    </div>
@endisset
