<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model {
    public $table = 'product';

    public $primarykey = 'id';

    public $timestamps = false;

    public $fillable = [
        'name',
        'price',
        'description',
        'photo'
    ];

}