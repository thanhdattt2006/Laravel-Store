<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItems;

class Cart extends Model
{
    public $table = 'cart';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'account_id',
    ];

    public function items()
    {
        return $this->hasMany(CartItems::class);
    }
}
