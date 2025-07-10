<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Account extends Model {
    public $table = 'account';

    public $primaryKey  = 'id';

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