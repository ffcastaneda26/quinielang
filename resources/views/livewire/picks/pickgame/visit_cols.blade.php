{{-- Equipo Visita --}}
<td class="py-3 text-sm">
    <img src="{{ Storage::url('teams/' . $game->visit_team->logo) }}" class="h-[30px] w-[30px] rounded-full">
</td>
<td class="text-start ml-2">
    {{ $game->visit_team->name }}
</td>
