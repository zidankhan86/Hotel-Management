<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([

            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'phone' => '01712345678',
            'address' => 'Mirpur-1',
            'role' => 'admin',
            'password' => 'password',

        ]);
    }
}
