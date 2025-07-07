<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cate extends Model {
    public $table = 'cate';

    public $primarykey = 'id';

    public $timestamps = false;

    public $fillable = [
        'name',
    ];

}