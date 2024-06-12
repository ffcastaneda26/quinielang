    {{-- Icono si acertó/falló o aún no se sabe --}}
    @if ($game_has_result)
        <img src="{{ $hit_game ? asset('images/afirmativo.png')
                               : asset('images/negativo.png') }}"
            width="25" height="25">
    @else
        <img src="{{ asset('images/' . env('IMG_TO_YET_PICK_GAME','reloj.jpg')) }}" width="25" height="25">
    @endif
