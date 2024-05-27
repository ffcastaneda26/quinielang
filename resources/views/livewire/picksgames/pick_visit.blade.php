    {{-- Datos de la visita --}}
    <td align="center" style="vertical-align:top;">
        <div style="width: 30px">
            <img src="{{Storage::url($game->visit_team->logo)}}" class="avatar-sm md:w-100 h-100">
        </div>
    </td>

    <td align="center" style="vertical-align:top;">
        <label class="rounded-pill  text-lg p-1.5
                {{ !is_null($game->visit_points) ? '' : 'd-none' }}
                {{ $game->winner == 2 ? 'bg-success' : 'bg-danger'}}">
            {{ $game->visit_points }}
        </label>
    </td>
