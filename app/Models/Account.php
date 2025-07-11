<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Account extends Authenticatable {
    protected $table = 'account';

    protected $primaryKey  = 'id';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'fullname',
        'phone',
        'address',
        'role_id'
    ];

}