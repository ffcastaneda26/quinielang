<div>
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden dark:text-white">
            <div class="text-center uppercase mt-2 dark:text-white">
                <p>{{ __('Round') }}</p>
            </div>
            <div class="d-flex justify-content-center text-center mb-2">
                <select class="w-auto text-black"
                        wire:model="round_selected"
                        wire:change="round_select">
                    @foreach ($rounds as $round)
                        <option value="{{ $round->id }}">{{ $round->id }}</option>
                    @endforeach
                </select>
            </div>
    </div>

    <div class="justify-center  hidden sm:block dark:text-white ">
            <div class="text-center uppercase">
                <p>{{ __('Rounds') }}</p>
            </div>
            <div class="d-flex justify-content-center text-center mb-2">
                @foreach ($rounds as $round)
                    <button wire:click="select_round({{ $round->id }})"
                        class="cursor-pointer inline-flex items-center px-1 py-1
                                        bg-white
                                        text-black
                                        rounded-full
                                        font-bold text-xs
                                {{ $current_round->id == $round->id ? 'bg-green-300' : '' }}
                                {{ $selected_round->id == $round->id ? 'bg-yellow-400' : '' }}"
                        title="{{ $round->id }} {{ $current_round->id == $round->id ? __('Current Round') : '' }}">
                        {{ $round->id }}
                    </button>
                @endforeach
            </div>
    </div>
</div>
