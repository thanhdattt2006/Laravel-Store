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

    // Lấy tất cả ảnh qua các biến thể
    // public function variant_photo()
    // {
    //     return $this->hasManyThrough(
    //         Photo::class,               // bảng cần lấy cuối cùng
    //         Product_variant::class,     // bảng trung gian
    //         'product_id',               // khóa ngoại ở product_variant trỏ tới product
    //         'product_variant_id',       // khóa ngoại ở photo trỏ tới product_variant
    //         'id',                       // khóa chính ở bảng product
    //         'id'                        // khóa chính ở bảng product_variant
    //     );
    // }
    // public function color()
    // {
    //     return $this->belongsTo(Colors::class, 'colors_id');
    // }
}
