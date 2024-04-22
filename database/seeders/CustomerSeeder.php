<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([

            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'phone' => '01712345678',
            'address' => 'Uttara-10',
            'role' => 'customer',
            'password' => '12345',

        ]);
    }
}
