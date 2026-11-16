<x-layouts.site>
    <x-slot:title>Mon profil</x-slot:title>
    <div>
        <p class="uppercase text-xs text-gold mb-5">Espace membre</p>
        <h1 class="font-display uppercase text-4xl md:text-6xl leading-none">Mon profil</h1>
        <p class="my-5 text-muted max-w-md">Ton espace de membre : tes boosters, ta collection et les dernières nouvelles.</p>
    </div>

    <div class="flex flex-wrap justify-center gap-6 mb-10 md:gap-10 mt-10">
        <div class="bg-card p-6 rounded-2xl flex-1 basis-[260px] max-w-sm">
            <h3 class="text-xl my-4">Boosters en attente</h3>
            <p class="font-display text-4xl md:text-6xl leading-none text-gold">X</p>
            <a href="{{ route('booster') }}" class="font-bold text-gold">Ouvrir un booster</a>
        </div>

        <div class="bg-card p-6 rounded-2xl flex-1 basis-[260px] max-w-sm">
            <h3 class="text-xl my-4">Prochain booster gratuit</h3>
            <p class="font-display text-4xl md:text-6xl leading-none text-gold">
                @if ($next)
                    {{ now()->diff($next)->h }}h {{ now()->diff($next)->i }}min
                @else
                    Booster disponible maintenant
                @endif
            </p>
            <p class="font-bold">X timeboosts disponibles</p>
        </div>
    </div>

    <div class="my-10">
        <h2 class="font-display uppercase text-2xl md:text-5xl leading-none">Mes infos</h2>

        <div class="bg-card rounded-lg p-5 sm:p-8 mt-8 flex flex-col gap-5 max-w-md mx-auto">

            <div class="flex gap-4 items-center">
                <div aria-hidden="true"
                     class="rounded-full bg-gold text-black w-16 h-16 flex items-center justify-center text-2xl font-semibold shrink-0">
                    {{ Str::upper(Str::substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-xl font-semibold">{{ $user->name }}</p>
                    <p class="text-sm text-gold">{{ $user->email }}</p>
                </div>
            </div>

            <div class="border-t border-gold"></div>

            <dl class="flex flex-col gap-4">
                <div>
                    <dt class="text-gold text-xl">Nom</dt>
                    <dd class="font-bold text-lg">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="text-gold text-xl">Adresse mail</dt>
                    <dd class="font-bold text-lg">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="text-gold text-xl">Mot de passe</dt>
                    <dd class="tracking-widest font-bold text-lg">••••••••••</dd>
                </div>
                <div>
                    <dt class="text-gold text-xl">Membre depuis le</dt>
                    <dd class="font-bold text-lg">{{ $user->created_at->format('d/m/Y') }}</dd>
                </div>
            </dl>
            <a href="{{route('profil-edit')}}" class="text-gold text-xl text-center">Modifier mes infos</a>
        </div>
    </div>

    <div class="my-10">
        <h2 class="font-display uppercase text-2xl md:text-5xl leading-none">Supprimer mon profil</h2>
        <p class="my-5 text-muted max-w-md">
            La suppression du compte inclut la perte de ta collection de cartes et de tes informations. Elle est définitive.
        </p>

        <details class="bg-card rounded-2xl p-6 max-w-md mx-auto" @if ($errors->has('password')) open @endif>
            <summary class="font-bold text-[#FF9A90] cursor-pointer min-h-11 flex items-center">
                Supprimer mon compte
            </summary>

            <form method="POST" action="{{ route('profil.destroy') }}" class="mt-4 flex flex-col gap-5">
                @csrf
                @method('DELETE')

                <div class="flex flex-col gap-1.5">
                    <label for="delete_password" class="font-bold text-sm">Mot de passe actuel, pour confirmer</label>
                    <input id="delete_password" name="password" type="password" required
                           class="w-full min-h-11 rounded-xl border border-[#7A7C78] bg-ink px-3.5 text-cream">
                    @error('password')
                    <span role="alert" class="text-sm text-[#FF9A90]">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="min-h-11 px-7 rounded-full border-2 border-[#FF9A90]/60 text-[#FF9A90] font-bold hover:opacity-90">
                        Supprimer définitivement
                    </button>
                </div>
            </form>
        </details>
    </div>

</x-layouts.site>
