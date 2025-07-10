<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_variant extends Model
{
    public $table = 'product_variant';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'product_id',
        'colors_id',
        'stock'
    ];
    public function variant()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    
}
