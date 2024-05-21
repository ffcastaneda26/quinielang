@auth
    @if (Route::has('picks'))
        <x-nav-link id="picks_nav" href="{{ route('picks') }}" :active="request()->routeIs('picks')">

            <label for="picks_nav" class="my-fondo-header">{{ __('Picks') }}</label>
        </x-nav-link>
    @endif

    @if (Route::has('results-by-round'))
        <x-nav-link id="results_by_round_nav" href="{{ route('results-by-round') }}" :active="request()->routeIs('results-by-round')">

            <label for="results_by_round_nav" class="my-fondo-header">Tabla de Pronósticos</label>
        </x-nav-link>
    @endif

    @if (Route::has('positions-by-round'))
        <x-nav-link id="position_by_round_nav" href="{{ route('positions-by-round') }}" :active="request()->routeIs('positions-by-round')">

            <label for="position_by_round_nav" class="my-fondo-header">Posiciones por Jornada</label>

        </x-nav-link>
    @endif

    @if (Route::has('positions-general'))
        <x-nav-link id="position_general_nav" href="{{ route('positions-general') }}" :active="request()->routeIs('positions-general')">

            <label for="position_general_nav" class="my-fondo-header">Posiciones Generales</label>

        </x-nav-link>
    @endif

    @if (Route::has('picks-review'))
        <x-nav-link id="picks_review_nav" href="{{ route('picks-review') }}" :active="request()->routeIs('picks-review')">

            <label for="picks_review_nav" class="my-fondo-header">Resultados por Jornada</label>
        </x-nav-link>
    @endif

@endauth
