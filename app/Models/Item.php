<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'image'];

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
