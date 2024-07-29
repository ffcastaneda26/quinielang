
<div class="container w-full mx-auto flex flex-col items-center mt-4">
    @if ($records->count())
        <div class="w-1/2">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-xxs sm:text-xs bg-gray-800 text-white text-center font-bold">
                        <th class="px-4 w-10 uppercase">Pos</th>
                        <th class="px-4 w-70 uppercase">{{ __('Name') }}</th>
                        <th class="px-4 w-70 uppercase">{{ __('Hits') }}</th>
                        <th class="px-4 w-70 uppercase">{{ __('MNFs') }}</th>
                        <th class="px-4 w-10 uppercase">{{ __('Total Error') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr class="border-bottom">
                            <td class="text-xxs sm:text-xs px-4 text-center">{{ $record->position }}</td>
                            <td
                                class="text-xxs sm:text-xs px-4 uppercase text-left {{ env('SHOW_NAME_POSITION_BY_ROUND', false) ? 'text-xxs' : '' }}">
                                {{ env('SHOW_NAME_GENERAL_POSITIONS', false) ? $record->user->name : $record->user->alias }}
                            </td>
                            <td class="text-xxs sm:text-xs px-4 text-center">{{ $record->hits }}</td>
                            <td class="text-xxs sm:text-xs px-4 text-center">{{ $record->hits_breaker }}</td>
                            <td class="text-xxs sm:text-xs px-4 text-center">{{ $record->total_error }}</td>
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

