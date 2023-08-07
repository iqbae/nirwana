<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\ManagementAccess\DetailUser;
use App\Models\ManagementAccess\RoleUser;
use App\Models\ManagementAccess\Role;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

use Auth;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),

            ]), function (User $user) use ($input) {

                
                // add to detail users and user default role pasien
                $detail_user = new DetailUser;
                $detail_user->user_id = $user->id;
                $detail_user->type_user_id = 3;
                $detail_user->contact = $input['contact'];
                $detail_user->address = $input['address'];
                $detail_user->photo = NULL;
                $detail_user->gender = NULL;
                $detail_user->save();

                // add to role user default type pasien
                $role_user = new RoleUser;
                $role_user->user_id = $user->id;
                $role_user->role_id = 5;
                $role_user->save();

            });
        });

    }
}
