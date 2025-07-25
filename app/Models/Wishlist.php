<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $table = 'wishlist';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'account_id',
        'product_id',
        'created_at',
        'updated_at'
    ];
     protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
