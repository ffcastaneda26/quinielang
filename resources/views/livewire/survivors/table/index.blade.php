<div class="container">
    @include('livewire.survivors.table.header')

    @foreach ($users as $user)
        @include('livewire.survivors.table.detail')
    @endforeach
</div>

