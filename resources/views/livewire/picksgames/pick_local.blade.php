   {{-- Datos del local --}}
   <div class="col-span-2 flex flex-col sm:flex-row items-center gap-10 text-xs">
        <img src="{{ Storage::url($game->local_team->logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">
       <div class="{{ $is_game_tie_breaker ? 'hidden' : '' }}">{{ $game->local_team->short }}</div>
   </div>
