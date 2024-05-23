<div>
    <div class="text-center uppercase">
        <p>COMPONENTE HIJO PAR LISTAR PENDIENTES</p>
    </div>
    <div class="flex flex-row justify-center mt-2 mb-4">
        <table class="w-full">
            <thead>
                <tr class="bg-black text-white font-bold text-center border border-gray-500">
                    <th>ID</th>
                    <tH>TAREA</th>
                    <th>¿TERMINADA?</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                    <tr>
                        @livewire('ejemplos.task', ['task' => $todo], key($todo->id))
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
