   {{-- Datos del Local --}}

   <div class="flex flex-row items-center">
        <div class="{{ $is_game_tie_breaker ? 'hidden': '' }}">{{ $game->visit_team->short }}</div>
   </div>
   <div class="flex flex-row items-center">
       <img src="{{ Storage::url($game->local_team->logo) }}" class="h-[30px] w-[30px] rounded-full ml-auto">
   </div>
