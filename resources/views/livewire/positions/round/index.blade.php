<div class="container w-full mx-auto flex flex-col items-center mt-4 bg-black text-white">
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

    @if ($records->count())
        <div class="w-full overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-center font-bold  bg-black text-white">
                        <th class="px-4 w-10 uppercase text-xs sm:text-sm border border-white">Pos</th>
                        <th class="px-4 w-70 uppercase text-xs sm:text-sm border border-white">{{ __('Name') }}</th>
                        <th class="px-4 w-10 uppercase text-xs sm:text-sm border border-white">{{ __('Hits') }}</th>
                        @if($show_mnf_column)
                            <th class="px-4 w-10 uppercase text-xs sm:text-sm border border-white">MNF</th>

                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr class="text-center font-bold"></tr>
                            <td class="bg-white text-black border border-black text-xs sm:text-sm px-4 text-center">{{ $record->position }}</td>
                            <td class="bg-white text-black border  border-black text-xs sm:text-sm px-4 uppercase text-left {{ env('SHOW_NAME_POSITION_BY_ROUND',false) ? 'text-xxs' : '' }}">
                                {{ env('SHOW_NAME_POSITION_BY_ROUND',false)  ? $record->user->name : $record->user->alias}}
                            </td>
                            <td class="bg-white text-black border border-black text-xs sm:text-sm px-4 text-center">{{ $record->hits }}</td>
                            @if($show_mnf_column)
                                <td class="bg-white text-black border border-black text-xs sm:text-sm px-4 text-center">
                                    <div class="flex flex-row justify-center justify-items-center">
                                        @if ($record->hit_last_game)
                                            <img src="{{ asset('images/afirmativo.png') }}" class="w-4 h-4">
                                        @else
                                            <img src="{{ asset('images/negativo.png') }}" class="w-4 h-4">
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="w-1/2 overflow-x-auto">
            <div class="text-center bg-red-500 font-bold">
                {{ __('Not Found Records') }}
            </div>
        </div>
    @endif

</div>
