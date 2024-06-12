<div>
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="bg-slate-50">
            <div class="text-center uppercase">
                <p>{{ __('Round') }}</p>
            </div>
            <div class="d-flex justify-content-center text-center mt-2 mb-4">

                <select class="w-full mt-3" 
                        wire:model="round_selected"
                        wire:change="round_select">
                    <option value="">Seleccionar ronda</option>
                    @foreach ($rounds as $round)
                        <option value="{{ $round->id }}">{{ $round->id }}</option>
                    @endforeach
                </select>
                {{-- <button wire:click="select_round({{ $round->id }})"
                            class="cursor-pointer inline-flex items-center px-2 py-2 mx-2
                                    bg-gray-50   dark:bg-gray-200
                                    border border-black
                                    rounded-full
                                    font-bold text-xs text-black dark:text-gray-800
                                    hover:bg-cyan-200 dark:hover:bg-white
                                    focus:bg-green-200 dark:focus:bg-white
                            {{ $current_round->id == $round->id ? 'bg-yellow-300'  : '' }}
                            {{ $selected_round->id == $round->id ? 'bg-green-400' : '' }}"
                            title="{{ $round->id }} {{ $current_round->id == $round->id ? __('Current Round')  : '' }}">
                            {{ $round->id }}
                        </button> --}}
            </div>
        </div>
    </div>

    <div class="flex justify-center mt-2 hidden sm:block">
        <div class="bg-slate-50">
            <div class="text-center uppercase">
                <p>{{ __('Rounds') }}</p>
            </div>
            <div class="d-flex justify-content-center text-center mt-2 mb-4">
                @foreach ($rounds as $round)
                    <button wire:click="select_round({{ $round->id }})"
                        class="cursor-pointer inline-flex items-center px-2 py-2 mx-2
                                        bg-gray-50   dark:bg-gray-200
                                        border border-black
                                        rounded-full
                                        font-bold text-xs text-black dark:text-gray-800
                                        hover:bg-cyan-200 dark:hover:bg-white
                                        focus:bg-green-200 dark:focus:bg-white
                                {{ $current_round->id == $round->id ? 'bg-yellow-300' : '' }}
                                {{ $selected_round->id == $round->id ? 'bg-green-400' : '' }}"
                        title="{{ $round->id }} {{ $current_round->id == $round->id ? __('Current Round') : '' }}">
                        {{ $round->id }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>
