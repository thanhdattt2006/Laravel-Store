<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = [
        'title',
        'photo',
        'description',
        'content',
        'created_at',
        'updated_at',
        'account_id'
    ];

    public $timestamps = false; 

}
