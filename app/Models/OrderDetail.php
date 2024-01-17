<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;
    protected $fillable = [
        'id_product',
        'id_order',
        'quantity',
        'price',
    ];

    public $timestamps = false;
    protected $table = 'orderdetail';
    protected $primaryKey = ['id_product', 'id_order'];
    public $incrementing = false;

    public function product(){
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }
}
