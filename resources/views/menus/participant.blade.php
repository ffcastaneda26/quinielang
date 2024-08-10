@auth
    <div class="flex flex-row justify-between text-xxs">
        @if (Route::has('picks'))
            <x-nav-link id="picks_nav" href="{{ route('picks') }}" :active="request()->routeIs('picks')">
                <label for="picks_nav">{{ __('Picks') }}</label>
            </x-nav-link>
        @endif

        @if (Route::has('table-picks'))
            <x-nav-link id="table-picks" href="{{ route('table-picks') }}" :active="request()->routeIs('table-picks')">
                <label for="table-picks"> {{ __('Picks Table') }}</label>
            </x-nav-link>
        @endif

        @if (Route::has('positions-by-round'))
            <x-nav-link id="positions-by-round" href="{{ route('positions-by-round') }}" :active="request()->routeIs('positions-by-round')">
                <label for="positions-by-round"> {{ __('Round Positions') }}</label>
            </x-nav-link>
        @endif


        @if (Route::has('user-survivors'))
            <x-nav-link id="user-survivors" href="{{ route('user-survivors') }}" :active="request()->routeIs('user-survivors')">
                <label for="user-survivors"> {{ __('Survivors') }}</label>
            </x-nav-link>
        @endif

        @if (Route::has('table-survivors'))
            <x-nav-link id="table-survivors" href="{{ route('table-survivors') }}" :active="request()->routeIs('table-survivors')">
                <label for="table-survivors"> {{ __('Table Survivors') }}</label>
            </x-nav-link>
        @endif
        @if (Route::has('position-general'))
            <x-nav-link id="position-general" href="{{ route('position-general') }}" :active="request()->routeIs('position-general')">
                <label for="position-general"> {{ __('General Positions') }}</label>
            </x-nav-link>
        @endif
    </div>

@endauth
