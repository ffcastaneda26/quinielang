<div>
    <div class="container w-full mx-auto flex flex-col items-center">
        <div class="w-full flex flex-col items-center">
            @livewire('select-round')
        </div>
        {{-- Encabezado  --}}
        @include('livewire.picks.tablepicks.table_picks_header')

        {{-- Detalle --}}
        <div class="w-full flex items-center mt-2">
            @foreach ($users as $user)
                <div class="w-full grid grid-cols-12 border">
                    <div class="w-auto col-span-2 border border-black text-left">{{ $user->name }}</div>

                    <div class="w-auto col-span-7 border border-black text-center">
                        <div class="flex flex-row">
                            @foreach ($user->picks as $pick)
                                @livewire('picks.tablepicks.picks-user', ['game' => $pick->game, 'user' => $user], key('pick-' . $pick->id))
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-col col-span-1 border items-center justify-start border-black">
                        <span class="block mt-2 py-5">{{ $user->positions->count() ? $user->positions->first()->hits : '' }}</span>
                    </div>
                    @if(env('PRINT_ACUMULATED_BY_ROUND',false))
                        <div class="flex flex-col col-span-1 border items-center justify-start border-black">
                            <span class="block mt-2 py-5">
                                {{ $user->generalPosition->count() ? $user->generalPosition->first()->hits : '' }}
                            </span>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>


    </div>
</div>
