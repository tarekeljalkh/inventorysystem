<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'admin',
                'role' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'user',
                'role' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('password'),
            ],
        ]);
    }
}
