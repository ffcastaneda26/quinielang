<div>
    {{-- Seleccionar Jornada --}}
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

    {{-- Encabezado: Tabla de Partidos --}}
    @include('livewire.picks.tablepicks.table_picks_header')

    {{-- Pronósticos por Usuario --}}

    @include('livewire.picks.tablepicks.table_picks_detail')

</div>
