<div class="col-span-2">
    &nbsp;
</div>

<div class="col-span-1 flex flex-col sm:flex-row items-center gap-4">
    &nbsp;
</div>

<div>
    <input type='number'
            wire:model="visit_points"
            wire:change="update_points"
            wire:blur="update_points"
            min=0
            max=99
            class="{{ $errors->has('visit_points') ? 'border border-red-500 border-double' : '' }}
            {{ $allow_pick ? '' : 'bg-slate-200' }}"
            {{ $allow_pick ? '' : 'disabled' }}
        />
</div>
@error('visit_points')
    <span class="badge rounded-pill fondo-secundario">{{ $message }}</span>
@enderror

{{-- Espacio entre marcadores --}}
<div class="col-span-2">
    &nbsp;
</div>

{{-- Puntos locales --}}
<div>
    <input type='number'
            wire:model="local_points"
            wire:change="update_points"
            wire:blur="update_points"
            min=0
            max=99
            class="{{ $errors->has('local_points') ? 'border border-red-500 border-double' : '' }}
            {{ $allow_pick ? '' : 'bg-slate-200' }}"
            {{ $allow_pick ? '' : 'disabled' }}
        />
</div>
@error('local_points')
    <span class="badge rounded-pill fondo-secundario">{{ $message }}</span>
@enderror
