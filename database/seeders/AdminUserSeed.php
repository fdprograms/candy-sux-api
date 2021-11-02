<?php

namespace Database\Seeders;

use App\Models\Company;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::firstOrCreate(
            ['name' => 'Default'],
            [
                'uuid' => \Str::uuid(),
                'name' => 'Default',
                'rnc' => 0
            ]
        );

        $user = User::firstOrCreate(
            ['email' => config('app.support_email')],
            [
                'uuid' => \Str::uuid(),
                'firstname' => 'Admin',
                'lastname' => 'Admin',
                'name' => 'admin',
                'email' => config('app.support_email'),
                'company_id' => $company->id,
                'password' => Hash::make(config('app.password'))
            ]
        );
        $roleId = Role::where('name', 'Admin')->first()->id;
        $user->roles()->attach($roleId);
    }
}
