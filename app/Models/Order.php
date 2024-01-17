<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'id_package',
        'statusPay',
        'statusDeli',
        'typePay',
        'note',
    ];

    protected $table = 'orders';
    protected $dates = ['created_at', 'updated_at'];

    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function orderdetail(){
        return $this->hasMany(OrderDetail::class, 'id_oder', 'id');
    }
}
