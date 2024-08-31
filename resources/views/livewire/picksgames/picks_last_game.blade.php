<div class="col-span-3">
    &nbsp;
</div>

<div class="col-span-1 flex flex-col justify-center items-center text-center">
        <div>
            <input type='number'
                    wire:model.live="visit_points"
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
            <div class="text-red-500">
                {{ $message }}
            </div>
        @enderror
</div>


<div class="col-span-1 flex flex-col sm:flex-row items-center gap-4">
    &nbsp;
</div>

<div class="col-span-1 flex flex-col justify-center items-center text-center">
    <div>
        <input type='number'
                wire:model.live="local_points"
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
        <div class="text-red-500">
            {{ $message }}
        </div>
    @enderror

</div>

