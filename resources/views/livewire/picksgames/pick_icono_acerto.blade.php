    {{-- Icono si acertó/falló o aún no se sabe --}}
    <td style="vertical-align: middle">

        @if($pick_user && $game_has_result)
            @if($hit_game)
                <img src="{{ asset('images/afirmativo.png') }}" width="25" height="25">
             @else
                <img src="{{ asset('images/negativo.png') }}"   width="25" height="25">
            @endif
        @else
            <img src="{{$is_game_tie_breaker ? asset('images/tie_breaker_game_icon.png') : asset('images/vs.png') }}" alt="X" width="25" height="25">
        @endif
    </td>

