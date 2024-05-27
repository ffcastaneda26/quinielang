   {{-- Datos del Local --}}
   <td align="center" style="vertical-align:top;">
       <label
           class="rounded-pill  text-md p-1.5
            {{ !is_null($game->local_points) ? '' : 'd-none' }}
            {{ $game->winner == 1 ? 'bg-success' : 'bg-danger' }}">
           {{ $game->local_points }}
       </label>
   </td>


   <td align="center" style="vertical-align:top;">
       <div style="width: 25px">
           <img src="{{ Storage::url($game->local_team->logo) }}" class="avatar-sm md:w-100 h-100">
       </div>
   </td>
