<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $fillable = [
        'account_id',
        'product_id',
        'blog_id',
        'about_id',
        'comment',
        'rating',
        'created_at',
        'updated_at'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
}
