<div class="container">
    <div class="mx-auto">
        @foreach ($users as $user)
            {{-- <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden"> --}}
                <table class="w-full border">
                        @if($loop->index == 0)
                            <thead>
                                <tr>
                                    <th class="text-center font-bold">{{ __('Name') }}</th>
                                    @foreach ($rounds as $round)
                                        <th class="text-center text-sm">{{ $round->id }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        @endif
                    <tbody>
                        <tr>
                            <td class="text-center font-bold">{{ $user->alias }}</td>
                            @foreach ($rounds as $round)
                                <td class="text-center">
                                    @php
                                        $user_survivor = $user->survivors->firstWhere('round_id', $round->id);
                                    @endphp
                                    @if ($user_survivor)
                                        <img src="{{ Storage::url($user_survivor->team->logo) }}" class="w-8">
                                    @else
                                        <img src="{{ asset('images/survivor_no_seleccionado.png') }}" class="w-8">
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            {{-- </div> --}}
        @endforeach
    </div>
</div>
