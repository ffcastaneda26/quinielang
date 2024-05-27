   {{-- Datos del Local --}}
   @include('livewire.picksgames.local_pick')

   <div class="flex flex-row items-center">
       <div>{{ $game->local_team->name }}</div>
   </div>
   <div class="flex flex-row items-center">
       <img src="{{ Storage::url('teams/' . $game->local_team->logo) }}" class="h-[30px] w-[30px] rounded-full ml-auto">
   </div>
