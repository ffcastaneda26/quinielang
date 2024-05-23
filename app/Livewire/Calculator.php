<?php

namespace App\Livewire;

use Livewire\Component;

class Calculator extends Component
{
    public $cantidad1,$cantidad2=0;
    public $operacion;
    public $resultado=0;

    public function render()
    {
        return view('livewire.calculator');
    }


    public function ope()
    {
        if($this->operacion == 1){
            $this->resultado = $this->cantidad1 + $this->cantidad2;
        }
        if($this->operacion == 2){
            $this->resultado = $this->cantidad1 - $this->cantidad2;
        }
        if($this->operacion == 3){
            $this->resultado = $this->cantidad1 * $this->cantidad2;
        }
        if($this->operacion == 4){
            $this->resultado = $this->cantidad1 / $this->cantidad2;
        }
    }
}
