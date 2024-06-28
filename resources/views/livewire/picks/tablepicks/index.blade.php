<div>
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

    @include('livewire.picks.tablepicks.table_picks_header')

    @foreach ($users as $user )
        @include('livewire.picks.tablepicks.table_picks_detail')
    @endforeach

</div>
