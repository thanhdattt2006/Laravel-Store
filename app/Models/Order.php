<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
    public $table = 'order';

    public $primaryKey  = 'id';

    public $timestamps = false;

    public $fillable = [
        'account_id',
        'payments_id',
        'voucher_discount_id',
        'total_price',
        'created-day',
        'update-day',
    ];

}