@php
    $input = 'w-full rounded-xl bg-card border border-white/10 px-4 py-3 text-cream placeholder:text-muted focus:border-gold focus:outline-none';
@endphp

<x-layouts.site>
    <x-slot:title>Créer un compte</x-slot:title>

    <div class="max-w-md mx-auto mt-6 md:mt-12">
        <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">Créer un compte</h1>
        <p class="text-muted mt-2">Ton compte devra ensuite être validé pour ouvrir des boosters.</p>

        <form method="POST" action="{{ route('register.store') }}" class="mt-8 flex flex-col gap-5 bg-card/50 border border-white/10 rounded-2xl p-6 md:p-8">
            @csrf

            <div>
                <label for="name" class="block font-medium mb-2">Nom</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                       autocomplete="name" placeholder="Ton prénom ou pseudo" class="{{ $input }}">
                @error('name')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block font-medium mb-2">Adresse e-mail</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       autocomplete="email" placeholder="email@exemple.com" class="{{ $input }}">
                @error('email')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-medium mb-2">Mot de passe</label>
                <input id="password" name="password" type="password" required
                       autocomplete="new-password" placeholder="Mot de passe" class="{{ $input }}">
                @error('password')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block font-medium mb-2">Confirmer le mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       autocomplete="new-password" placeholder="Confirmer le mot de passe" class="{{ $input }}">
            </div>

            <button type="submit" data-test="register-user-button"
                    class="rounded-full bg-gold text-ink font-bold px-8 py-3 cursor-pointer">
                Créer mon compte
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-muted">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="text-gold font-bold">Se connecter</a>
        </p>
    </div>
</x-layouts.site>
