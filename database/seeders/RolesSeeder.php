<?php

namespace Database\Seeders;

use App\Models\Role as Roles;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::insert([
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Owner'
            ],
            [
                'name' => 'User'
            ]
        ]);
    }
}
