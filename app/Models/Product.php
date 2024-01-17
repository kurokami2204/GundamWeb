<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'categorized',
        'brand',
        'series',
        'scale',
        'product_line',
        'height',
        'link_img',
        'price',
        'unit',
        'description',
        
    ];

    protected $table = 'product';

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'link_img' => 'array'
    ];

    public function orderdetail(){
        return $this->hasMany(News::class, 'id_customer', 'id');
    }
}
