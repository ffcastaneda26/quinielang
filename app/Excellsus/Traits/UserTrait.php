<?php

namespace App\Excellsus\Traits;

trait UserTrait
{
    public function is($role){
        return $this->hasRole($role);
    }


    public function isAdmin(){
        return $this->is('Admin');
    }

    public function isParticipante(){
        return $this->is('Participante');
    }

}
