<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CategoriesItemsExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        // Retrieve all categories
        $categories = Category::all();

        // Create a new sheet for each category
        foreach ($categories as $category) {
            $sheets[] = new CategorySheet($category);
        }

        return $sheets;
    }
}
