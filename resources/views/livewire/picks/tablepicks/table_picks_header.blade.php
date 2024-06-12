{{-- Encabezado  --}}
<div class="w-full flex items-center mt-2">
    <div class="w-full grid grid-cols-12 border">
        {{-- <div class="w-auto col-span-2 border border-blue-900">NOMBRE</div> --}}
        <div class="w-auto col-span-2 border border-blue-900 flex items-center justify-center">NOMBRE</div>
        <div class="w-auto col-span-7 border border-blue-900 text-center">
            <div class="flex flex-row">
                @foreach ($round_games as $game)
                    <div class="flex flex-col text-center gap-4 ml-2">
                        @if($game->local_points || $game->visit_points)
                            <img src="{{ Storage::url($game->visit_team->logo) }}"
                                class="h-[25px] w-[25px] rounded-full mx-4 border-solid  shadow-xl
                                    {{  $game->visit_points > $game->local_points ? 'shadow-green-500 h-[35px] w-[35px] border-4 border-green-500'
                                                                                  : 'shadow-red-500 border-4 border-red-500'}} " >
                            <img src="{{ Storage::url($game->local_team->logo) }}"
                                class="h-[25px] w-[25px] rounded-full mx-4 shadow-xl
                                    {{  $game->local_points > $game->visit_points ? 'shadow-green-500 h-[35px] w-[35px] border-4 border-green-500'
                                                                                  : 'shadow-red-500 border-4 border-red-500'}}">
                            <span class="text-center">
                                <label class="rounded-full">
                                        {{ $game->visit_points }}
                                </label>
                                    <br>
                                <label class=" rounded-full">
                                    {{ $game->local_points }}</label>
                            </span>
                        @else
                            <img src="{{ Storage::url($game->visit_team->logo) }}"
                                class="h-[30px] w-[30px] rounded-full mx-4" >
                            <img src="{{ Storage::url($game->local_team->logo) }}"
                                class="h-[30px] w-[30px] rounded-full mx-4">
                        @endif


                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-auto col-span-1 border border-blue-900 flex items-center justify-center">ACIERTOS</div>
        @if(env('PRINT_ACUMULATED_BY_ROUND',false))
            <div class="w-auto col-span-1 border border-blue-900 flex items-center justify-center">ACUMULADO</div>
        @endif
    </div>
</div>
