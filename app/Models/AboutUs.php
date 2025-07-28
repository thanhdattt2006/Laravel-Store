<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    public $table = 'about_us';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'title',
        'description',
        'photo',
        'content',
        'created_at',
        'updated_at',
        'account_id'
    ];
 
}
