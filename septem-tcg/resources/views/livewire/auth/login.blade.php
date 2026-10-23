@php
    $input = 'w-full rounded-xl bg-card border border-white/10 px-4 py-3 text-cream placeholder:text-muted focus:border-gold focus:outline-none';
@endphp

<x-layouts.site>
    <x-slot:title>Connexion</x-slot:title>

    <div class="max-w-md mx-auto mt-6 md:mt-12">
        <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">Connexion</h1>
        <p class="text-muted mt-2">Retrouve ta collection et ouvre tes boosters.</p>

        @if (session('status'))
            <p class="mt-6 text-green-400">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="mt-8 flex flex-col gap-5 bg-card/50 border border-white/10 rounded-2xl p-6 md:p-8">
            @csrf

            <div>
                <label for="email" class="block font-medium mb-2">Adresse e-mail</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       autocomplete="email" placeholder="email@exemple.com" class="{{ $input }}">
                @error('email')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-medium mb-2">Mot de passe</label>
                <input id="password" name="password" type="password" required
                       autocomplete="current-password" placeholder="Mot de passe" class="{{ $input }}">
                @error('password')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-center gap-3 text-sm cursor-pointer">
                <input type="checkbox" name="remember" class="size-4 accent-gold" @checked(old('remember'))>
                Rester connecté·e
            </label>

            <button type="submit" data-test="login-button"
                    class="rounded-full bg-gold text-ink font-bold px-8 py-3 cursor-pointer">
                Se connecter
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-muted">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-gold font-bold">Créer un compte</a>
        </p>
    </div>
</x-layouts.site>
