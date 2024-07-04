<div class="container w-full mx-auto flex flex-col items-center mt-4">
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>
    {{-- <div class="w-auto flex flex-col items-center">
        @include('livewire.positions.round.header_table')

        <div class="row">
            @if ($records->count())
            <div class="flex flex-row w-full jutify-between gap-40 mt-4">
                @foreach ($records as $record)
                    <div>{{ $record->position }}</div>
                    <div>{{ $record->user->name }}</div>
                    <div>{{$record->hits}}</div>
                    <div>{{ $record->hit_last_game }}</div>
                @endforeach

            </div>

            @else
            <div class="flex flex-row w-full text-center bg-red-500 mt-10">
                {{ __('Not Found Records') }}
            </div>
            @endif
        </div>
    </div> --}}
    @if ($records->count())
        <div class="w-1/2 overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-white text-center font-bold">
                        <th class="px-4 w-10 uppercase">Pos</th>
                        <th class="px-4 w-70 uppercase">{{ __('Name') }}</th>
                        <th class="px-4 w-10 uppercase">{{ __('Hits') }}</th>
                        <th class="px-4 w-10 uppercase">{{ __('Last Game') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr class="border-bottom">
                            <td class="px-4 text-center">{{ $record->position }}</td>
                            <td class="px-4 uppercase text-left {{ env('SHOW_NAME_POSITION_BY_ROUND',false) ? 'text-xxs' : '' }}">
                                {{ env('SHOW_NAME_POSITION_BY_ROUND',false)  ? $record->user->name : $record->user->alias}}
                            </td>
                            <td class="px-4 text-center">{{ $record->hits }}</td>
                            <td class="px-4 text-center">
                                <div class="flex flex-row justify-center justify-items-center">
                                    @if ($record->hit_last_game)
                                        <img src="{{ asset('images/afirmativo.png') }}" class="w-4 h-4">
                                    @else
                                        <img src="{{ asset('images/negativo.png') }}" class="w-4 h-4">
                                    @endif
                                </div>
                            </td>
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
