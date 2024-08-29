<div class="col-span-2">
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
<div class="col-span-1 flex flex-col sm:flex-row items-center gap-4">
    &nbsp;
</div>
{{-- Espacio entre marcadores --}}
<div class="col-span-2">
    <div class="w-full text-center font-bold text-xxs {{ $allow_pick ? 'visible' : 'hidden' }}">
        <a href="{{ route('picks') }}">
            <button type="button"  class="inline-flex items-center px-2 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150']) }}">
                {{ __('Update') }}
            </button>
        </a>
    </div>
</div>
<div class="col-span-1 flex flex-col sm:flex-row items-center gap-4">
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
