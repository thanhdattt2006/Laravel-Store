<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    // ✅ Quan trọng để Laravel login bằng username
   
}