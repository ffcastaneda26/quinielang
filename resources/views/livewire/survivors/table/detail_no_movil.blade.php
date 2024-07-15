<div class="justify-center hidden sm:block">
    <div class="w-full grid grid-cols-12 border">
        <div class="col-span-1 flex items-center text-start">{{ $user->alias }}</div>
        <div class="col-span-11">
            <div class="flex flex-row justify-between items-center border-collapse border-4 border-red-500">
                @foreach ($rounds as $round)
                    <div class="flex flex-col items-center border-2 border-gray-200 p-1">
                        @php
                            $user_survivor = $user->survivors->firstWhere('round_id', $round->id);
                        @endphp
                        @if ($user_survivor)
                            <img src="{{ Storage::url($user_survivor->team->logo) }}"
                                 class="w-8 h-8 rounded-md {{ $user_survivor->survive ? 'shadow-xl shadow-green-500' : 'grayscale' }}">
                                 <label class="text-xs">{{ $user_survivor->round_id }}</label>
                        @else
                            <div class="w-8 h-8"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
