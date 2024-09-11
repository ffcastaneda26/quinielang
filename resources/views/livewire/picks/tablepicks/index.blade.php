<div class="container w-full mx-auto flex flex-col items-center ">
    <div class="flex flex-row justify-center dark:text-white mt-2 uppercase">
       {{ __('Picks Table') }}
     </div>
     <div class="w-full flex flex-col items-center">
        @livewire('select-round')
    </div>

     <div wire:loading.delay.shortest>
        <div class="bg-white text-black h-max flex flex-col text-center justify-center items-center">
            {{ __('Loading...') }}
        </div>
    </div>

    <div wire:loading.class="hidden">

        {{-- Seleccionar Jornada --}}



        {{-- Encabezado: Tabla de Partidos --}}
        @include('livewire.picks.tablepicks.table_picks_header')

        {{-- Pronósticos por Usuario --}}

        @include('livewire.picks.tablepicks.table_picks_detail')
    </div>


</div>
