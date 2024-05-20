@auth
    @if(!Auth::user()->paid && !Auth::user()->hasrole('Admin')  &&  $configuration_record->require_payment_to_continue)
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            <script async   src="https://js.stripe.com/v3/buy-button.js"> </script>
            <stripe-buy-button
                buy-button-id="buy_btn_1NhTzSG2UqMVjdJhbchOp1dP"
                publishable-key="pk_test_51NhHU2G2UqMVjdJhSv2kF1wE7Yc7hJQG93HQsjtGq9QqFaoQiQMYrK7OM5G1NwK1f5PuESMsTO6PspW1rXpwqg5100xgSNl6RB"
            >
            </stripe-buy-button>
        </x-nav-link>
    @else


        @role('participante')
            @if(!Auth::user()->has_suplementary_data() &&  $configuration_record->require_data_user_to_continue)
                <x-nav-link id="data_users_nav" href="{{ route('data-users') }}" :active="request()->routeIs('data-users')">
                    <label for="data_users_nav" class="my-fondo-header">Datos Complementarios</label>
                </x-nav-link>
            @else

                @if (Route::has('picks'))
                    <x-nav-link id="picks_nav" href="{{ route('picks') }}" :active="request()->routeIs('picks')">

                        <label for="picks_nav" class="my-fondo-header">Pronósticos</label>
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


            @endif

        @endrole

    @endif

@endauth
