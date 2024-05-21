@auth
    <div class="flex items-start flex-col">

        @if (Route::has('dashboard'))
            <x-responsive-nav-link href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        @endif

        @if (Route::has('picks'))
            <x-responsive-nav-link href="{{ route('picks') }}">
                Pronósticos
            </x-responsive-nav-link>
        @endif

        @if (Route::has('results-by-round'))
            <x-responsive-nav-link href="{{ route('results-by-round') }}">
                Tabla de Pronósticos
            </x-responsive-nav-link>
        @endif

        @if (Route::has('positions-by-round'))
            <x-responsive-nav-link href="{{ route('positions-by-round') }}">
                Posiciones por Jornada
            </x-responsive-nav-link>
        @endif

        @if (Route::has('positions-general'))
            <x-responsive-nav-link href="{{ route('positions-general') }}">
                Posiciones Generales
            </x-responsive-nav-link>
        @endif

        @if (Route::has('picks-review'))
            <my-responsive-nav-link id="picks_review_nav" href="{{ route('picks-review') }}"
                :active="request() - > routeIs('picks-review')">
                <label for="picks_review_nav" class="my-fondo-header">Resultados por Jornada</label>
            </my-responsive-nav-link>
        @endif

    </div>
@endauth
