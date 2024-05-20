@auth
    <div class="flex items-start flex-col">

        @if (Route::has('dashboard'))
            <x-my-responsive-nav-link href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </x-my-responsive-nav-link>
        @endif

        @if (Route::has('picks'))
            <x-my-responsive-nav-link href="{{ route('picks') }}">
                Pronósticos
            </x-my-responsive-nav-link>
        @endif

        @if (Route::has('results-by-round'))
            <x-my-responsive-nav-link href="{{ route('results-by-round') }}">
                Tabla de Pronósticos
            </x-my-responsive-nav-link>
        @endif

        @if (Route::has('positions-by-round'))
            <x-my-responsive-nav-link href="{{ route('positions-by-round') }}">
                Posiciones por Jornada
            </x-my-responsive-nav-link>
        @endif

        @if (Route::has('positions-general'))
            <x-my-responsive-nav-link href="{{ route('positions-general') }}">
                Posiciones Generales
            </x-my-responsive-nav-link>
        @endif

        @if (Route::has('picks-review'))
            <my-responsive-nav-link id="picks_review_nav" href="{{ route('picks-review') }}"
                :active="request()->routeIs('picks-review')">
                <label for="picks_review_nav" class="my-fondo-header">Resultados por Jornada</label>
            </my-responsive-nav-link>
    @endif

        @endif
    </div>
@endauth
