<h1>Page Galerie</h1>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @forelse ($cards as $card)
        <div>
            <h2>{{ $card->title }}</h2>
            <p>{{ $card->number }}</p>
        </div>
    @empty
        <p>Aucune carte pour l'instant.</p>
    @endforelse
</div>
