<div class="col-span-2">
    &nbsp;
</div>


<div>
    <input type='number'
            wire:model.live="visit_points"
            wire:change="update_points"
            wire:blur="update_points"
            min=0
            max=99
            class="{{ $errors->has('visit_points') ? 'border border-red-500 border-double' : '' }}
            {{ $allow_pick ? '' : 'bg-slate-200' }}"
            {{-- {{ $allow_pick ? '' : 'disabled' }} --}}
            :disabled="!$allow_pick"
        />
</div>
@error('visit_points')
    <span class="badge rounded-pill fondo-secundario">{{ $message }}</span>
@enderror
<div class="col-span-1 flex flex-col sm:flex-row items-center gap-4">
    &nbsp;
</div>
{{-- Espacio entre marcadores --}}
<div class="col-span-2">
    <div class="w-full text-center font-bold text-xxs {{ $allow_pick ? 'visible' : 'hidden' }}">
        <a href="{{ route('picks') }}">
            <button type="button"  class="inline-flex px-2 py-2 bg-black text-white rounded-md  text-xs uppercase ">
                {{ __('Update') }}
            </button>
        </a>
    </div>
</div>
<div class="col-span-1 flex flex-col sm:flex-row items-center gap-4">
    {{ $allow_pick }}
</div>
{{-- Puntos locales --}}
<div>
    <input type='number'
            wire:model.live="local_points"
            wire:change="update_points"
            wire:blur="update_points"
            min=0
            max=99
            class="{{ $errors->has('local_points') ? 'border border-red-500 border-double' : '' }}
            {{ $allow_pick ? '' : 'bg-slate-200' }}"
            {{-- {{ $allow_pick ? '' : 'disabled' }} --}}
            :disabled="!$allow_pick"
        />
</div>
@error('local_points')
    <span class="badge rounded-pill fondo-secundario">{{ $message }}</span>
@enderror
