{{-- Datos del Local --}}
<td class="text-start ml-2">
    {{ $game->local_team->name }}
</td>
<td class="py-3 text-sm">
    <img src="{{ Storage::url('teams/' .$game->local_team->logo) }}" class="h-[30px] w-[30px] rounded-full">
</td>
