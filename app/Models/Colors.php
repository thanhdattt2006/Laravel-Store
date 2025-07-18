<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    public $table = 'colors';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'name',
    ];
    public function colors()
    {
        return $this->hasMany(Colors::class, 'colors_id');
    }
}
