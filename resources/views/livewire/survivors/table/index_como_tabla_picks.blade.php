<div class="container mt-5">
    {{-- Encabezado --}}
    <div class="w-full grid grid-cols-12 border bg-white text-black">
        <div class="col-span-2 flex items-center text-center border font-bold text-xxs bg-white text-black sm:text-sm md:text-lg lg:text-2xl">{{ __('Name') }}</div>
        <div class="col-span-9 bg-white text-black">
            <div class="flex flex-row gap-1 justify-between items-center border bg-white text-black">
                @foreach ($rounds as $round)
                    <div class="flex flex-row justify-center items-center w-full">
                        <div class="col-span-1 gap-1 text-center sm:text-lg">
                            {{ $round->id }}
                        </div>
                    </div>
                @endforeach
    
            </div>
        </div>
        <div class="col-span-1 flex items-center text-center font-bold justify-center ml-2  bg-white text-black text-xxs sm:text-sm md:text-lg lg:text-2xl">T</div>
    </div>

    {{-- Survivors x Usuario --}}
    @foreach ($users as $user )
        <div class="w-full grid grid-cols-12 text-xxs sm:text-sm md:text-lg lg:text-2xl bg-white text-black text-center">
            <div class="col-span-2 flex items-center text-center font-bold">{{ $user->alias }}</div>
            <div class="col-span-9">
                <div class="flex flex-row gap-1 justify-between items-center">
                    @foreach ($rounds as $round)
                        <div class="col-span-1 flex items-center justify-center font-bold">
                            @php
                                $user_survivor = $user->survivors->firstWhere('round_id', $round->id);
                            @endphp

                            @if ($user_survivor)
                                @if ($round->has_games_to_block_survivors())
                                       <img src="{{ Storage::url($user_survivor->team->logo) }}"
                                            class="w-4 h-4 sm:w-8 sm:h-8 rounded-full shadow-md  {{ $user_survivor->survive ? 'shadow-green-500' : 'grayscale' }}"
                                        >
                                @else
                                    <img src="{{ asset('images/reloj.png') }}" lass="w-4 sm:w-8 rounded-full" style="margin: 0 auto;">
                                @endif
                            @else
                                @if ($round->has_games_to_block_survivors())
                                    <img src="{{ asset('images/survivor_no_seleccionado.png') }}" class="w-4 sm:w-8 rounded-full grayscale" style="margin: 0 auto;">
                                @else
                                    <img src="{{ asset('images/reloj.png') }}" class="w-4 sm:w-8 rounded-full" style="margin: 0 auto;">
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-span-1 flex items-center border justify-center font-bold text-xxs bg-white text-black sm:text-sm md:text-lg lg:text-2xl">
                {{ $user->total_survivors}}
            </div>
        </div>
    @endforeach
</div>