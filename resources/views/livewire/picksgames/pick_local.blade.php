   {{-- Datos del local --}}
   <div class="col-span-2 flex  sm:flex-row items-center gap-10 text-xs">
        {{  $game_has_result ? $game->local_points : '' }}
        <img src="{{ Storage::url($local_logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">
   </div>
