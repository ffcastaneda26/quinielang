<div  wire:poll class="container w-full mx-auto flex flex-col items-center ">
    <div class="flex flex-row justify-center dark:text-white mt-2 uppercase">
       {{ __('Picks Table') }}
     </div>
    {{-- Seleccionar Jornada --}}
    <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

    {{-- Encabezado: Tabla de Partidos --}}
    @include('livewire.picks.tablepicks.table_picks_header')

    {{-- Pronósticos por Usuario --}}

    @include('livewire.picks.tablepicks.table_picks_detail')

</div>
