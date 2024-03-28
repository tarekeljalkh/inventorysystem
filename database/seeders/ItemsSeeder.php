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
                'category_id' => '2'
            ],
            [
                'name' => 'stage',
                'quantity' => '2',
                'category_id' => '1'
            ],
            [
                'name' => 'item3',
                'quantity' => '2',
                'category_id' => '1'
            ],
            [
                'name' => 'item4',
                'quantity' => '2',
                'category_id' => '2'
            ],

        ]);
    }
}
