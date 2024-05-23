<?php

namespace App\Livewire\Ejemplos;

use App\Models\Todo as TodoModel;
use Livewire\Component;
use Illuminate\Console\View\Components\Task;

class Todo extends Component
{
    public $task;
    public $status;


    public function mount(Todo $task){
        $this->task = $task;
    }
    public function render()
    {
        return view('livewire.ejemplos.todo');
    }

    public function update_status(){
        if(!$this->task) return;
        $task = Task::findOrFail($this->task->id);

        $task->finished = $finished ? 1 : 0;
        $task->save();
    }
}
