@auth
    <div class="flex items-start flex-col">

        @if (Route::has('picks'))
            <x-responsive-nav-link href="{{ route('picks') }}">
                Pronósticos
            </x-responsive-nav-link>
        @endif

        @if (Route::has('table-picks'))
            <x-responsive-nav-link href="{{ route('table-picks') }}">
                Tabla de Pronósticos
            </x-responsive-nav-link>
        @endif


        @if (Route::has('positions-by-round'))
            <x-responsive-nav-link href="{{ route('positions-by-round') }}">
                Posiciones por Jornada
            </x-responsive-nav-link>
        @endif

        @if (Route::has('position-general'))
            <x-responsive-nav-link href="{{ route('position-general') }}">
                {{ __('General Positions') }}
            </x-responsive-nav-link>
        @endif

        @if (Route::has('user-survivors'))
            <x-responsive-nav-link href="{{ route('user-survivors') }}">
                Survivors
            </x-responsive-nav-link>
        @endif

        @if (Route::has('table-survivors'))
            <x-responsive-nav-link href="{{ route('table-survivors') }}">
                {{ __('Table Survivors') }}
            </x-responsive-nav-link>
        @endif


    </div>
@endauth
