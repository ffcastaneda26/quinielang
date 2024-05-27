<div wire:poll>
    <div class="container mx-auto  bg-gray-100 rounded-md px-4 py-2 my-2">
        <div class="grid grid-cols-9">
            <div class="col-span-2">{{ $game->game_date->format('y') }}
                {{ $game->game_time->format('H:i') }}
            </div>

            <div class="col-span-2 flex flex-row items-center gap-10">
                <img src="{{ Storage::url('teams/' . $game->visit_team->logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">
                <div>{{ $game->visit_team->name }}</div>
            </div>

            <div class="col-span-3 flex flex-row items-center gap-10 justify-center">
                <input type="radio" wire:model.live="pick_user_winner" wire:click="update_winner_game"
                    name="winner-game{{ $game->id }}" value="2" {{ $allow_pick ? '' : 'disabled' }}
                    {{ $pick_user_winner === 2 ? 'checked' : '' }} />

                @if ($game_has_result)
                    @if ($hit_game)
                        <img src="{{ asset('images/afirmativo.png') }}" width="25" height="25">
                    @else
                        <img src="{{ asset('images/negativo.png') }}" width="25" height="25">
                    @endif
                @else
                    <img src="{{ asset('images/balon.jpg') }}" width="25" height="25">
                @endif

                <input type="radio" wire:model.live="pick_user_winner" wire:click="update_winner_game"
                    name="winner-game{{ $game->id }}" value="1" {{ $allow_pick ? '' : 'disabled' }}
                    {{ $pick_user_winner === 1 ? 'checked' : '' }} />
            </div>

            <div class="col-span-2 flex flex-row items-center">
                <div>{{ $game->local_team->name }}</div>
                <img src="{{ Storage::url('teams/' . $game->local_team->logo) }}"
                    class="h-[30px] w-[30px] rounded-full ml-auto">
            </div>
        </div>
    </div>
</div>
