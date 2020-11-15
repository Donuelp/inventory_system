<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'id' => 1,
            'name' => 'Admin',
            // 'user_name' => 'admin',
            'email' => 'admin@black.com',
            'role_id' => 1,
            // 'employee_id' => 001
        ]);

        factory(App\User::class)->create([
            'id' => 2,
            'name' => 'Creator',
            // 'user_name' => 'creator',
            'email' => 'creator@black.com',
            'role_id' => 2,
            // 'employee_id' => 002
        ]);

        factory(App\User::class)->create([
            'id' => 3,
            'name' => 'Member',
            // 'user_name' => 'member',
            'email' => 'member@black.com',
            'role_id' => 3,
            // 'employee_id' => 003
        ]);
    }
}
