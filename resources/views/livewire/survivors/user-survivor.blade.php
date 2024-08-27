<div wire:wire:poll.15000ms>
    <div class="container mx-auto  bg-gray-100 rounded-md px-4 py-0 my-1">
        <div class="grid grid-cols-5 text-xxs sm:text-lg">
            <div class="col-span-1 text-left">{{ $round->id }}</div>
            <div class="col-span-1 text-center">
                @if ($user_survivor_current)
                        <img src="{{ Storage::url($user_survivor_current->team->logo) }}"
                            class="h-[30px] w-[30px] rounded-full mr-2">
                @else
                    &nbsp;
                @endif
            </div>
            <div class="col-span-1 text-center">
                @if ($user_survivor_current)
                    @if($game_played)
                        @if ($user_survivor_current->survive)
                            <img src="{{ asset('images/afirmativo.png') }}" class="h-[15px] w-[15px]">
                        @else
                            <img src="{{ asset('images/negativo.png') }}" class="h-[15px] w-[15px]">
                        @endif
                    @endif
                @else
                    <img src="{{ asset('images/survivor_no_seleccionado.png') }}" class="h-[15px] w-[15px]">
                @endif
            </div>
            <div class="col-span-1 text-center">
                @if ($user_survivor_current)
                    <x-button wire:click="delete_survivor({{ $user_survivor_current }})"
                        class="w-12 {{ $round_has_games_to_block_survivors ? 'hidden' : '' }}"
                        title="{{ __('Delete') }}">
                        <img src="{{ asset('images/negativo.png') }}" class="p-0">
                    </x-button>
                @else
                    &nbsp;
                @endif
            </div>
            <div class="col-span-1 text-center">
                    <select wire:model="team_id"
                    wire:change="update_team_survivor({{ $round->id }})"
                    wire:click="update_team_survivor({{ $round->id }})"
                    user-select:none
                    class="text-xxs sm:text-sm" class="text-xxs sm:text-sm"
                    {{ $round_has_games_to_block_survivors ? 'disabled' : '' }}>
                @if ($user_survivor_current)
                    <option value="">{{ $user_survivor_current->team->name }}</option>
                @else
                    <option class="bg-red-500" value="">Ninguno</option>
                @endif
                @foreach ($teams as $team)
                    @if(!$team->has_user_survivor_round($round->id))
                        <option value="{{ $team->id }}">
                            {{ $team->name }}
                        </option>
                    @endif
                @endforeach

            </select>



            </div>


        </div>
    </div>
</div>
