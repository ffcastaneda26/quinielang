<div wire:poll.15s>
    <div class="container mx-auto  bg-gray-100 rounded-md px-4 py-1 my-1">
        <div class="grid grid-cols-5">
            <div class="col-span-1">{{ $round->id }}</div>
            <div class="col-span-1">
                <img src="{{ Storage::url($user_survivor_current->team->logo) }}" class="h-[30px] w-[30px] rounded-full mr-2">
                <span class="text-xxs">{{ $user_survivor_current->team->name }}</span>
            </div>
            <div class="col-span-1">
                @if($user_survivor_current)
                    @if($round_has_games_played)
                        @if($user_survivor_current->survive)
                            <img src="{{ asset('images/afirmativo.png') }}" class="h-[15px] w-[15px]">
                        @else
                            <img src="{{ asset('images/negativo.png') }}" class="h-[15px] w-[15px]">
                        @endif
                    @endif
                @endif
            </div>
            <div class="col-span-1">
                @if ($user_survivor_current && !$round_has_games_played)
                    <x-button wire:click="delete_survivor({{ $user_survivor_current }})"
                              class="bg-red-500 text-xxs">X
                    </x-button>

                @endif
            </div>

            <div class="col-span-1">
                    <select wire:model="team_id"

                            wire:change="update_team_survivor({{ $round->id }})"
                            wire:click="$refresh"
                            {{ $round_has_games_played ? 'disabled' : ''}}
                                                 class="text-xxs sm:text-sm"
                            class="text-xxs sm:text-sm">
                        @if($round_has_games_played)
                            <option value="">{{ $user_survivor_current->team->name }}</option>
                        @else
                            <option class="bg-red-500" value="">NO SELECCION</option>
                            @foreach ($teams as $team)
                                <option  value="{{ $team->id }}">
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        @endif

                    </select>
            </div>

        </div>
    </div>
</div>
