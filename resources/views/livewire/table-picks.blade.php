    <div class="container w-full mx-auto flex flex-col items-center">
        <div class="w-full flex flex-col items-center">
            @livewire('select-round')
        </div>

        {{-- Encabezado  --}}
        <div class="w-full flex items-center mt-2">
            <div class="w-full grid grid-cols-12 border">
                {{-- <div class="w-auto col-span-2 border border-blue-900">NOMBRE</div> --}}
                <div class="w-auto col-span-2 border border-blue-900 flex items-center justify-center">NOMBRE</div>
                <div class="w-auto col-span-7 border border-blue-900 text-center">
                    <div class="flex flex-row">
                        @foreach ($round_games as $game)
                            <div class="flex flex-col text-center gap-4 ml-2">
                                <img src="{{ Storage::url($game->visit_team->logo) }}"
                                    class="h-[30px] w-[30px] rounded-full mx-4">
                                <img src="{{ Storage::url($game->local_team->logo) }}"
                                    class="h-[30px] w-[30px] rounded-full mx-4">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-auto col-span-1 border border-blue-900 flex items-center justify-center">MNF</div>

                <div class="w-auto col-span-1 border border-blue-900 flex items-center justify-center">ACIERTOS
                </div>
                <div class="w-auto col-span-1 border border-blue-900 flex items-center justify-center">ACUMULADO</div>
            </div>
        </div>
        {{-- Detalle --}}
        <div class="w-full flex items-center mt-2">
            @foreach ($records as $user)
                <div class="w-full grid grid-cols-12 border">
                    <div class="w-auto col-span-2 border border-black text-left">{{ $user->name }}</div>
                    <div class="w-auto col-span-7 border border-black text-center">
                        <div class="flex flex-row">
                            @foreach ($round_games as $game)
                                <div class="flex flex-col text-center gap-4 ml-2 items-center justify-center">
                                    @if ($game->allow_pick())
                                        <img src="{{ asset('images/balon.png') }}"
                                            class="h-[30px] w-[30px] rounded-full mx-4">
                                    @else
                                        <img src="{{ Storage::url($game->visit_team->logo) }}"
                                            class="h-[30px] w-[30px] rounded-full mx-4">
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="w-auto col-span-1 border border-black text-center">99-99</div>
                    <div class="w-auto col-span-1 border border-black text-center">999</div>
                    <div class="w-auto col-span-1 border border-black text-center">999</div>
                </div>
            @endforeach
        </div>


    </div>
