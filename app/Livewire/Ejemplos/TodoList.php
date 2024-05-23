<?php

namespace App\Livewire\Ejemplos;

use Illuminate\Console\View\Components\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoList extends Component
{

    public $status;
    public $finished;
    public function render()
    {

        return view('livewire.ejemplos.todo-list', [
            'todos' => Auth::user()->todos,
        ]);
    }

    // public function update_status($task_id)
    // {

    //     dd('Hola crayola' . $this->finished . 'tarea id=' . $task_id);

    // }
}
