    {{-- Datos de la visita --}}
    <div class="col-span-2 flex flex-row items-center gap-10">
        <img src="{{ Storage::url($game->visit_team->logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">
        <div>{{ $game->visit_team->name }}</div>
    </div>

    @include('livewire.picksgames.visit_pick')
