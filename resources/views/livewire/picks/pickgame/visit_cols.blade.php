{{-- Equipo Visita --}}
<td>
    <img src="{{ Storage::url('teams/' . $game->visit_team->logo) }}" class="h-[30px] w-[30px] rounded-full">

</td>
<td>
    {{ $game->visit_team->name }}
</td>
