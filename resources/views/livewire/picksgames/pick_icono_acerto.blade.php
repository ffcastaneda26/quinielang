    {{-- Icono si acertó/falló o aún no se sabe --}}
    <div class="text-center {{ $is_game_tie_breaker ? 'mt-4' : '' }}">
        @if ($game_has_result)
            <img src="{{ $hit_game ? asset('images/afirmativo.png') : asset('images/negativo.png') }}"
                width="{{  $is_game_tie_breaker ? '15' : '25' }}" height="{{  $is_game_tie_breaker ? '15' : '25' }}">
        @else
            <img src="{{ asset('images/' . env('IMG_TO_YET_PICK_GAME', 'reloj.jpg')) }}"
                width="{{  $is_game_tie_breaker ? '15' : '25' }}"
                height="{{  $is_game_tie_breaker ? '15' : '25' }}">
        @endif
    </div>
