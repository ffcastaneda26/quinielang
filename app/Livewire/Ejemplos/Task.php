<?php

namespace App\Livewire\Ejemplos;

use App\Models\Todo;
use Livewire\Component;

class Task extends Component
{
    public $task;
    public $finished;

    public function mount(Todo $task){
        $this->task = $task;
    }
    public function render()
    {
        return view('livewire.ejemplos.task');
    }

    public function update_status()
    {
        $this->task->finished = $this->finished ? 1 : 0;
        $this->task->save();
    }
}
