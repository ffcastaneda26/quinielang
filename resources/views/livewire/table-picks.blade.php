<div class="container w-full mx-auto flex flex-col items-center">
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

    <div class="flex flex-row mt-5">
        <div class="w-full flex flex-col items-center justify-center">
            <span class="font-bold text-lg">{{ __('Name') }}</span>
        </div>

        @foreach ($round_games as $game)
            {{-- <div class="w-full flex flex-col items-center justify-center"> --}}
                <div class="flex flex-col  space-x-4 justify-center ml-4">
                    <img src="{{ Storage::url($game->visit_team->logo) }}" class="h-[30px] w-[30px] rounded-full mx-4">
                    <br>
                    <img src="{{ Storage::url($game->local_team->logo) }}" class="h-[30px] w-[30px] rounded-full">
                </div>
            {{-- </div> --}}
        @endforeach

        <div class="w-full flex flex-col items-center justify-center mx-4">
            <span class="font-bold text-lg">MNF</span>
        </div>

        <div class="w-full flex flex-col items-center justify-center mx-4">
            <span class="font-bold text-lg uppercase">{{ __('Hits') }}</span>
        </div>

        <div class="w-full flex flex-col items-center justify-center mx-4">
            <span class="font-bold text-lg uppercase">{{ __('Accumulated') }}</span>
        </div>
    </div>
</div>
