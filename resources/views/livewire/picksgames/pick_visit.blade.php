    {{-- Datos de la visita --}}
    <div class="col-span-2 flex flex-col sm:flex-row justify-center items-center gap-4 text-xs">
        <div class="flex gap-1">
            <img src="{{ Storage::url($visit_logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">
            {{  $game_has_result ? $game->visit_points : '' }}
        </div>
    </div>

