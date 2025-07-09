<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Account extends Model {
    public $table = 'account';

    public $primarykey = 'id';

    public $timestamps = false;

    public $fillable = [
        'username',
        'password',
        'fullname',
        'phone',
        'address',
        'role_id'
    ];

}