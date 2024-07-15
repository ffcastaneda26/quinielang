<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="w-full grid grid-cols-12 border">
        <div class="col-span-2 flex items-center text-start ">{{ $user->alias }}</div>
        <div class="col-span-10">
            <div class="flex flex-row  justify-between items-center border-collapse border-4 border-red-500">
                @foreach ($user->survivors->sortBy('round_id') as $user_survivor)
                        <div class="col-span-1 ">
                            @foreach ($rounds as $round)
                                @if($round->id == $user_survivor->round_id)
                                    <img src="{{ Storage::url($user_survivor->team->logo) }}"
                                                class="w-4 h-4 rounded-md
                                                {{ $user_survivor->survive  ? 'shadow-xl shadow-green-500' : 'grayscale' }}"
                                    >
                                    <span>{{ $user_survivor->round_id }}</span>
                                
                                @endif
                            @endforeach
                        </div>
                @endforeach
            </div>
        </div>
    </div>
</div>