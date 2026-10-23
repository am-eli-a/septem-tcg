<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Septem TCG' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&family=Archivo:wght@400;500;700&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ink text-cream font-body flex flex-col min-h-screen">

<header class="border-b border-white/10">
    <nav class="relative w-full max-w-300 mx-auto px-4 md:px-12 py-4 flex items-center justify-between">

        <a href="{{ route('home') }}" class="shrink-0">
            <img src="{{ asset('storage/logo/Logo_FNpng.png') }}" alt="Septem TCG" class="h-12 md:h-20">
        </a>

        <button id="burger" type="button" aria-label="Menu" aria-expanded="false" aria-controls="menu"
                class="md:hidden p-2 rounded-lg border border-white/10 text-cream">
            <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
            </svg>
        </button>

        <div id="menu" class="flex max-md:hidden flex-col gap-4 absolute top-full inset-x-0 z-50 bg-ink border-b border-white/10 px-4 py-5 md:static md:flex-row md:items-center md:gap-10 md:p-0 md:border-0 md:bg-transparent">

            @guest
                <a href="{{ route('galerie') }}">Galerie</a>
                <a href="{{ route('login') }}">Se connecter</a>
                <a href="{{ route('register') }}">Créer un compte</a>
            @endguest

            @auth
                @if (auth()->user()->isMember())
                    <a href="{{ route('booster') }}">Booster</a>
                    <a href="{{ route('collection') }}">Ma collection</a>
                    <a href="{{ route('galerie') }}">Galerie</a>
                @else
                    <a href="{{ route('galerie') }}">Galerie</a>
                    <a href="{{ route('pending') }}">Compte en attente</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Me déconnecter</button>
                </form>
            @endauth
        </div>
    </nav>
</header>

<main class="flex-1 max-w-300 mx-auto px-4 md:px-12 py-10 w-full">
    {{ $slot }}
</main>

<footer class="border-t border-white/10">
    <div class="flex flex-col items-center gap-6 text-center max-w-300 mx-auto px-4 md:px-12 py-10 md:py-15
            md:flex-row md:justify-between md:text-left">
        <img src="{{ asset('storage/logo/Logo_FNpng.png') }}" alt="logo Septem24" class="h-20 w-auto">
        <p class="text-muted">Un projet de l'association Septem 24<br>
        Amelia DEV</p>
    </div>
</footer>

</body>
</html>
