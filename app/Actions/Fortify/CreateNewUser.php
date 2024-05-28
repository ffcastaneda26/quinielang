<?php

namespace App\Actions\Fortify;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'alias' => ['required', 'string', 'max:50','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


       $user= User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'alias' => $input['alias'],
            'password' => Hash::make($input['password']),
            'active'    => 1
        ]);

        $configuration = Configuration::first();
        if($configuration->assig_role_to_user){
            $participant_role = Role::where('name',env('ROLE_PARTICIPANT','Participante'))->first();
            if($participant_role){
                $user->assignRole($participant_role);
            }
        }

        return $user;
    }
}
