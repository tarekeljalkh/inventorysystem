<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategorySheet implements FromCollection, WithTitle, WithHeadings
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Assuming 'items' is a relationship method in your Category model
        return $this->category->items()->get(['name', 'quantity', 'out_quantity', 'image']); // Select the columns you want to export
    }

    /**
     * @return string
     */
    public function title(): string
    {
        // Use the category name as the sheet title
        return $this->category->name;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define the headings for your Excel sheet
        return ['Name', 'Quantity', 'Out Quantity', 'Image'];
    }
}
