<div wire:poll>
    <div class="container w-full mx-auto flex flex-col items-center">
        <div class="w-auto flex flex-col items-cente  py-2  text-black dark:text-white dark:bg-black">
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
</div>
