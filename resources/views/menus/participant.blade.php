@auth
    @if (Route::has('picks'))
        <x-nav-link id="picks_nav" href="{{ route('picks') }}" :active="request()->routeIs('picks')">

            <label for="picks_nav" class="my-fondo-header">{{ __('Picks') }}</label>
        </x-nav-link>
    @endif

    @if (Route::has('table-picks'))
        <x-nav-link id="table-picks" href="{{ route('table-picks') }}" :active="request()->routeIs('table-picks')">
            <label for="table-picks"> {{ __('Picks Table') }}</label>
        </x-nav-link>
    @endif




@endauth
