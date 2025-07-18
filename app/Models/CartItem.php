<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public $table = 'cart_items';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'product_id',
        'cart_id',
        'quantity',
        'total',
        'size'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // hoặc 'product_id' nếu tên khóa ngoại là vậy
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
