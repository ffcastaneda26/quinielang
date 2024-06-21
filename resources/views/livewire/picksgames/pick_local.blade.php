   {{-- Datos del Local --}}

   <div class="flex flex-row items-center">
       <div>{{ $game->local_team->short }}</div>
   </div>
   <div class="flex flex-row items-center">
       <img src="{{ Storage::url($game->local_team->logo) }}" class="h-[30px] w-[30px] rounded-full ml-auto">
   </div>
