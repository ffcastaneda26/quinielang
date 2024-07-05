<div wire:poll>
   <div class="container w-full mx-auto flex flex-col items-center">
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
    </div>
</div>
