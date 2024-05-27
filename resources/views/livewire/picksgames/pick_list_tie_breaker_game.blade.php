{{-- Puntos Visita --}}
<td align="center">
    <input type='number'
            wire:model="visit_points"
            wire:change="update_points"
            wire:blur="update_points"
            min=0
            max=999
            style="font-size: 8px;"
            class="w-auto {{ $errors->has('visit_points') ? 'border border-danger border-3' : '' }}"
            {{ $allow_pick ? '' : 'disabled' }}
        >
    @error('visit_points')
        <span class="badge rounded-pill fondo-secundario">{{ $message }}</span>
    @enderror
</td>
{{-- Icono si acertó/falló o aún no se sabe --}}

@include('livewire.picksgames.pick_icono_acerto')


{{-- Puntos Local --}}
<td align="center">
    <input type='number'
            wire:model="local_points"
            wire:change="update_points"
            wire:blur="update_points"
            min=0
            max=999
            style="font-size: 8px;"
            class="w-auto {{ $errors->has('local_points') ? 'border border-danger border-3' : '' }}" {{ $allow_pick ? '' : 'disabled' }}>

        @error('local_points')
            <span class=" badge rounded-pill fondo-secundario">{{ $message }}</span>
        @enderror

</td>
