<div wire:poll>
    <div class="col-lg-12">
        <div class="row border-1 my-2 {{ $is_game_tie_breaker ? 'bg-gray-200 text-black' : '' }}" class="">
            <div class="flex flex-row justify-evenly">
                <div class="col flex flex-col justify-center">
                    <div>
                        {{ $game_day . '-' . $game_month }}
                    </div>
                    <div>
                        {{ $game->game_time->format('H:i') }}
                    </div>
                </div>

                @include('livewire.picksgames.pick_visit_cols')

                @if ($configuration->require_points_in_picks)
                    @include('livewire.picksgames.pick_tie_braker_game_cols')
                @else
                    @include('livewire.picksgames.pick_no_require_points_in_picks')
                @endif

                @include('livewire.picksgames.pick_local_cols')
            </div>
        </div>
    </div>

</div>
