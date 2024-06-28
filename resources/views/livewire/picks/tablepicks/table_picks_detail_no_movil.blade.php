<div class="justify-center  hidden sm:block">
    <div class="w-full grid grid-cols-12 border">
        <div class="col-span-2 flex items-center text-start ">{{ $user->alias }}</div>
        <div class="col-span-9">
            <div class="flex flex-row gap-2 justify-between items-center border">
                @foreach ($user->picks->sortBy('game.game_date') as $pick)
                    <div class="col-span-1 gap-2">
                        @livewire('picks.table-picks.user-pick', ['pick' => $pick], key('pick-' . $pick->id))
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
