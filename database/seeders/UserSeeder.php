<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'nasr',
            'last_name' => 'hassan',
            'roles' => 'admin',
            'email' => 'nasrkihagila@gmail.com',
            'email_verified_at' => now() ,
            'password' => bcrypt('9007Hassan14@'),
        ]);
    }
}
