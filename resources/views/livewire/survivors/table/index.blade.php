<div class="container">
    <div class="mx-auto">
        @include('livewire.survivors.table.header')

        @foreach ($users as $user)
            @include('livewire.survivors.table.detail')
        @endforeach
    </div>
</div>

