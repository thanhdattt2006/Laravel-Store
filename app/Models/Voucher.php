<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher_discount';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'code_name',
        'discount_value',
        'stock'
    ];

}