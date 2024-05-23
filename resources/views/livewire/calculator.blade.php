<div>
    <div class="flex justify-between w-full">
        <input type="number" wire:model.live="cantidad1" wire:change="operacion">
        <Select wire:model.live='operacion'>
            <option value="">Seleccione</option>
            <option value="1">Sumar</option>
            <option value="2">Restar</option>
            <option value="3">Multiplicar</option>
            @if ($cantidad1 > 0)
                <option value="4">Dividir</option>
            @endif
        </Select>
        <input type="number" wire:model.live="cantidad2" wire:change="operacion">
    </div>

    @if($resultado !=0)
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">RESULTADO  {{ $resultado }}</div>
        </div>
    @endif
    <div class="flex justify-between w-full">
        <button wire:click="ope" class="bg-red-500 text-white font-bold py-2 px-4 rounded">Calcular</button>
    </div>

</div>
