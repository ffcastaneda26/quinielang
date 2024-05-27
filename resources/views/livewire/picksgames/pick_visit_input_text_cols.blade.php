{{-- Puntos Visita --}}
<div class="col flex justify-center">
    <div class="flex flex-col justify-center">
        @if($allow_pick)
            <input type='number'
                    wire:model="visit_points"
                    wire:change="update_points"
                    wire:blur="update_points"
                    min=0
                    max=99
                    size="100px"
                    style="font-size: 8px;"
                    class="text-center w-auto {{ $errors->has('visit_points') ? 'border border-danger border-3' : '' }}
                                            {{ $allow_pick ? '' : 'bg-slate-200' }}"
                    {{ $allow_pick ? '' : 'disabled' }}>
            @error('visit_points')
                <span class="badge rounded-pill fondo-secundario">{{ $message }}</span>
            @enderror
        @else
            <label for="" class="text-center">{{ $visit_points }}</label>
        @endif
    </div>
</div>
