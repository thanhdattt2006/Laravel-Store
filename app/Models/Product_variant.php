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
    public function photos()
    {
        return $this->hasMany(Photo::class, 'product_variant_id', 'id');
    }
   public function colors()
{
    return $this->belongsTo(Colors::class, 'colors_id', 'id');
}


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    

}
