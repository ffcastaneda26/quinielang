<div wire:wire:poll.15000ms>

    <div class="container mx-auto  bg-white text-black dark:bg-black dark:text-white rounded-md px-4 py-0 my-1">
        <div class="grid grid-cols-6 text-xxs sm:text-lg">

            {{-- Jornada --}}
            <div class="col-span-1 flex justify-start items-center">{{ $round->id }}</div>

            {{-- Equipo seleccionado --}}
            <div class="col-span-1 flex justify-start items-center">
                    @if ($user_survivor_current)
                        <div class="flex flex-col justify-center">
                            <div class="flex flex-row justify-center">
                                <img src="{{ Storage::url($user_survivor_current->team->logo) }}"
                                class="h-[30px] w-[30px] rounded-full mr-2">
                            </div>
                        </div>
                    @else
                        &nbsp;
                    @endif
            </div>

            {{-- Acertó o no  --}}
            <div class="col-span-1 flex justify-start items-center">
                @if ($user_survivor_current)
                    @if($game_played)
                        @if ($user_survivor_current->survive)
                            <img src="{{ asset('images/afirmativo.png') }}" class="h-[15px] w-[15px]">
                        @else
                            <img src="{{ asset('images/negativo.png') }}" class="h-[15px] w-[15px]">
                        @endif
                    @else
                        <img src="{{ asset('images/reloj.png') }}" class="h-[15px] w-[15px]">
                    @endif
                @else
                    &nbsp;
                @endif
            </div>

            {{-- Equipo contrario --}}
            <div class="col-span-1 flex justify-center items-center">
                @if ($user_survivor_current)
                    <div class="flex flex-col justify-center">
                        <div class="flex flex-row justify-center">
                            <img src="{{ Storage::url($user_survivor_current->team->id == $game->local_team_id ? $game->visit_team->logo : $game->local_team->logo) }}"
                                class=" w-6 h-6 rounded-full mr-2 grayscale">
                        </div>
                    </div>
                @else
                    &nbsp;
                @endif
            </div>


            {{-- Botón para eliminar selección --}}
            <div class="col-span-1 flex justify-start items-center">
                <x-button wire:click="delete_survivor({{ $user_survivor_current }})"
                            class="w-4 h-4 flex justify-center text-2xl font-extrabold
                            {{  $round_has_games_to_block_survivors ? 'bg-gray-500' : 'bg-red-500' }}
                            {{  $round_has_games_to_block_survivors || !$user_survivor_current ? 'hidden': ''}}"
                            title="{{ __('Delete') }}">
                    X
                </x-button>
            </div>

            {{-- Seleccionar Equipo --}}
            <div class="col-span-1 flex justify-center items-center">
                @if($user_survivor_current)
                    <label  style="width: 96px;font-size: 0.75rem;">
                        {{ $user_survivor_current->team->name }}
                    </label>
                @else
                    <select wire:model="team_id"
                            wire:change="update_team_survivor({{ $round->id }})"
                            wire:click="update_team_survivor({{ $round->id }})"
                            user-select:none
                            style="width: 96px;"
                            class="text-xxs sm:text-sm text-black dark:text-white dark:bg-black"
                            {{ $round_has_games_to_block_survivors ? 'disabled' : '' }}>

                            <option class="bg-red-500" value="">Ninguno</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team['id']}}">
                                    {{ $team['label'] }}
                                </option>
                            @endforeach
                    </select>
                @endif

            </div>


        </div>
    </div>
</div>
