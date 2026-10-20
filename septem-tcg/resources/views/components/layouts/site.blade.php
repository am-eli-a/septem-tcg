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

<div class="max-w-500 mx-auto px-12 py-6 flex items-center justify-between w-full">
    <a href="{{ route('home') }}">
        <img src="{{ asset('storage/logo/Logo_FNpng.png') }}" alt="logo Septem24" class="h-20 w-auto">
    </a>
    <nav>
        <ul class="flex items-center gap-10">
            @guest
                <li><a href="{{ route('galerie') }}">Galerie</a></li>
                <li><a href="{{ route('login') }}">Se connecter</a></li>
                <li><a href="{{ route('register') }}">Créer un compte</a></li>
            @endguest
            @auth
                @if (auth()->user()->isMember())
                    <li><a href="{{ route('booster') }}">Booster</a></li>
                    <li><a href="{{ route('collection') }}">Ma collection</a></li>
                    <li><a href="{{ route('galerie') }}">Galerie</a></li>
                @else
                    <li><a href="{{ route('galerie') }}">Galerie</a></li>
                    <li><a href="{{ route('pending') }}">Ma collection</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Me déconnecter</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>
</div>

<main class="flex-1 max-w-500 mx-auto px-12 py-10 w-full">
    {{ $slot }}
</main>

<footer class="border-t border-white/10">
    <div class="flex justify-between max-w-500 mx-auto px-12 py-15 items-center">
        <img src="{{ asset('storage/logo/Logo_FNpng.png') }}" alt="logo Septem24" class="h-15 w-auto">
        <p>Un projet de l'association Septem 24<br>
        Amelia DEV</p>
    </div>
</footer>

</body>
</html>
