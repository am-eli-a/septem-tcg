<x-layouts.site>
    <x-slot:title>Mon profil - modifier</x-slot:title>

    <section class="max-w-2xl mx-auto w-full flex flex-col gap-8">
        <div>
            <p class="uppercase text-xs text-gold mb-5">Espace membre</p>
            <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">Mon profil</h1>
            <p class="my-5 text-muted max-w-md">Modifie ton pseudo, ton adresse e-mail ou ton mot de passe.</p>
        </div>

        @if (session('status'))
            <div role="status" class="rounded-xl bg-[#14301D] text-[#7FD99A] font-bold text-sm px-4 py-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="#" class="bg-card rounded-2xl p-6 flex flex-col gap-5">
            @csrf
            @method('PUT')
            <h2 class="font-display uppercase text-2xl md:text-3xl leading-none">Informations</h2>

            <div class="flex flex-col gap-1.5">
                <label for="name" class="font-bold text-sm">Pseudo</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                       class="w-full min-h-11 rounded-xl border border-[#7A7C78] bg-ink px-3.5 text-cream">
                @error('name') <span role="alert" class="text-sm text-[#FF9A90]">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="email" class="font-bold text-sm">Adresse e-mail</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                       class="w-full min-h-11 rounded-xl border border-[#7A7C78] bg-ink px-3.5 text-cream">
                @error('email') <span role="alert" class="text-sm text-[#FF9A90]">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-wrap justify-end gap-3">
                <a href="{{ route('profil') }}"
                   class="inline-flex items-center justify-center min-h-11 px-6 rounded-full border-2 border-white/45 text-cream font-bold">
                    Annuler
                </a>
                <button type="submit"
                        class="min-h-11 px-7 rounded-full bg-gold text-ink font-bold hover:opacity-90">
                    Enregistrer
                </button>
            </div>
        </form>

        <form method="POST" action="#" class="bg-card rounded-2xl p-6 flex flex-col gap-5">
            @csrf
            @method('PUT')
            <h2 class="font-display uppercase text-2xl md:text-3xl leading-none">Mot de passe</h2>

            <div class="flex flex-col gap-1.5">
                <label for="current_password" class="font-bold text-sm">Mot de passe actuel</label>
                <input id="current_password" name="current_password" type="password" autocomplete="current-password" required
                       class="w-full min-h-11 rounded-xl border border-[#7A7C78] bg-ink px-3.5 text-cream">
                @error('current_password') <span role="alert" class="text-sm text-[#FF9A90]">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="password" class="font-bold text-sm">Nouveau mot de passe</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required
                       class="w-full min-h-11 rounded-xl border border-[#7A7C78] bg-ink px-3.5 text-cream">
                @error('password') <span role="alert" class="text-sm text-[#FF9A90]">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col gap-1.5">
                <label for="password_confirmation" class="font-bold text-sm">Confirmer le mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                       class="w-full min-h-11 rounded-xl border border-[#7A7C78] bg-ink px-3.5 text-cream">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="min-h-11 px-7 rounded-full bg-gold text-ink font-bold hover:opacity-90">
                    Changer le mot de passe
                </button>
            </div>
        </form>
    </section>
</x-layouts.site>
