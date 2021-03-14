<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'first_name' => 'admin',
          'last_name' => 'admin',
          'role' => User::ROLE_ADMIN,
          'email' => 'admin@admin.com',
          'password' => Hash::make('123'),
        ])
    }
}
