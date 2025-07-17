<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    public $table = 'cart-items';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'product_id',
        'cart_id',
        'quantity'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
