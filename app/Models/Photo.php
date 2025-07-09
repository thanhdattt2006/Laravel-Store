<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $table = 'photo';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'name',
    ];
    public function variant_photo()
    {
        return $this->belongsTo(Product_variant::class, 'product_id');
    }
}
