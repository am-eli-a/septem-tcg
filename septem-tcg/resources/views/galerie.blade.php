<h1>Page Galerie</h1>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @forelse ($cards as $card)
        <div>
            <h2>{{ $card->title }}</h2>
            <p>{{ $card->number }}</p>
            <img src = {{ asset('storage/' .$card->path) }}>
        </div>
    @empty
        <p>Aucune carte pour l'instant.</p>
    @endforelse
</div>
