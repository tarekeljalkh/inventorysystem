<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::insert([
            [
                'name' => 'test1',
                'mobile' => '53456346',
                'residency_number' => '4343535'
            ],
            [
                'name' => 'test2',
                'mobile' => '3242355325',
                'residency_number' => '23425'
            ],
            [
                'name' => 'test3',
                'mobile' => '345345345',
                'residency_number' => '23425346'
            ]
        ]);
    }
}
