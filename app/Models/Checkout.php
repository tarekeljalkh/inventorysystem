<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'quantity', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'checkout_items')->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkoutItems()
    {
        return $this->hasMany(CheckoutItem::class);
    }


    public function returnedBy()
    {
        return $this->belongsTo(User::class, 'returned_by_user_id');
    }

    //return orders that are nullable in return date

    public function scopeNotReturnedToStock($query)
    {
        return $query->whereDoesntHave('items', function ($query) {
            $query->whereNotNull('return_date');
        });
    }
}
