<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details'; // Tên bảng
    protected $primaryKey = 'id'; // Khóa chính
    public $timestamps = false; // Tắt timestamps
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'price',
        'total_price',
        'color_id',
        'size'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function color()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }
}
