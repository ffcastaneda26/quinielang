<div>
    <div class="container w-full mx-auto flex flex-col items-center">
        <div class="w-full flex flex-col items-center">
            @livewire('select-round')
        </div>
        {{-- Encabezado  --}}
        @include('livewire.picks.tablepicks.table_picks_header')
        {{-- Detalle --}}
        <div class="w-full flex items-center mt-2">
            @foreach ($users as $user)
                <div class="w-full grid grid-cols-12 border">
                    <div class="w-auto col-span-2 border border-black text-left">{{ $user->name }}</div>
                    @include('livewire.picks.tablepicks.picks-user')

                    @livewire('user-round-position', ['user' => $user, 'round_id' => $selected_round->id], key('rp-' . $user->id))

                    @livewire('user-general-position', ['user' => $user], key('gp-' . $user->id))

                </div>
            @endforeach
        </div>


    </div>
</div>
