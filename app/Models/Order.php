<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order'; 
    protected $primaryKey = 'id'; 
    public $timestamps = false; 
    protected $fillable = [
        'account_id',
        'payments_id',
        'voucher_discount_id',
        'grand_price',
        'created_day', 
        'updated_day', 
        'fullname' ,
        'address' ,
        'phone' ,
        'note' ,
        'status'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payments_id', 'id');
    }

    
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_discount_id', 'id');
    }
}