<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="w-full grid grid-cols-12 border">
        <div class="col-span-1 flex items-center text-start">{{ $user->alias }}</div>
        <div class="col-span-11">
            <div class="flex flex-row justify-between items-center border-collapse">
                @foreach ($rounds as $round)
                    <div class="flex flex-col items-center border-2 border-gray-200 p-1">
                        @php
                            $user_survivor = $user->survivors->firstWhere('round_id', $round->id);
                        @endphp
                        @if ($user_survivor)
                            <img src="{{ Storage::url($user_survivor->team->logo) }}"
                                class="w-2 h-2 rounded-full {{ $user_survivor->survive ? 'shadow-xl shadow-green-500' : 'grayscale' }}">
                        @else
                            <div class="w-2 h-2 border-2 border-black"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
