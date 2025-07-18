<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    public $table = 'cart_items';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'product_id',
        'cart_id',
        'quantity'
    ];
}
