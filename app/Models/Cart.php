<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;

class Cart extends Model
{
    public $table = 'cart';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'account_id',
    ];
    public function cartItems()
{
    return $this->hasMany(CartItem::class);
}
}
