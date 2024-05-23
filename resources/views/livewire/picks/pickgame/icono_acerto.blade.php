    {{-- Icono si acertó/falló o aún no se sabe --}}
    <td>
        @if ($game_has_result)
            @if ($hit_game)
                <img src="{{ asset('images/afirmativo.png') }}" width="25" height="25">
            @else
                <img src="{{ asset('images/negativo.png') }}" width="25" height="25">
            @endif
        @else
            <img src="{{ asset('images/balon.jpg') }}" width="25" height="25">
        @endif
    </td>
