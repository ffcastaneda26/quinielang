<div wire:poll>
    <div class="container w-full mx-auto flex flex-col items-center">
        <div class="w-auto flex flex-col items-cente MT-5 py-4">
            <p>SURVIVORS</p>
        </div>
        <div class="w-auto flex flex-col items-center">
            <div class="w-full bg-black text-white text-center font-bold text-xxs">
                <div class="grid grid-cols-5 text-xxs sm:text-lg">
                    <div class="col-span-1 text-center">{{ __('Jor') }}</div>
                    <div class="col-span-1 text-center">{{ __('Team') }}</div>
                    <div class="col-span-1 text-center">{{ __('Hit') }}</div>
                    <div class="col-span-1 text-center">{{ __('Delete') }}</div>
                    <div class="col-span-1 text-center">{{ __('Select') }}</div>
                </div>
            </div>

            {{-- Detalle --}}
            @foreach ($rounds as $round)
                @livewire('survivors.user-survivor',['round' => $round,
                                                    'minutesBefore' => $minutesBefore],
                                                key('round_' . $round->id))
            @endforeach
        </div>
    </div>

   {{-- <div class="container w-full mx-auto flex flex-col items-center">
        <div class="w-auto flex flex-col items-center mt-5">
            <div class="container mx-auto  bg-black text-white rounded-md py-1 my-1">
                <div class="grid grid-cols-5 text-xxs">
                    <div class="col-span-1 uppercase w-0.5">Jor</div>
                    <div class="col-span-1 uppercase">{{ __('Team') }}</div>
                    <div class="col-span-1 uppercase">{{ __('Hit') }}</div>

                    <div class="col-span-1 uppercase">{{ __('Delete') }}</div>
                    <div class="col-span-1 uppercase">{{ __('Select') }}</div>
                    </div>
            </div>

            @foreach ($rounds as $round)

                    @livewire('survivors.user-survivor',['round' => $round,
                                                        'minutesBefore' => $minutesBefore],
                                                        key('round_' . $round->id))

            @endforeach
        </div>
    </div> --}}
</div>
