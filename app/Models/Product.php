<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'product';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'name',
        'price',
        'description',
        'photo',
        'cate_id'
    ];
    public function cate()
    {
        return $this->belongsTo(Cate::class, 'cate_id');
    }
    // Lấy tất cả biến thể của sản phẩm
    public function variant()
    {
        return $this->hasMany(Product_variant::class, 'product_id');
    }

   
}
