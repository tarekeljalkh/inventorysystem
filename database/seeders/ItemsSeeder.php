<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::insert([
            [
                'name' => 'speaker Bose',
                'quantity' => '10',
            ],
            [
                'name' => 'stage',
                'quantity' => '2',
            ],
        ]);
    }
}
