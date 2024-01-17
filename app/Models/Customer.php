<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $guard = 'customer';
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'address',
        'phone_number',
        'link_img'
    ];
    protected $table = 'customer';
    public $timestamps = false;

    public function orders(){
        return $this->hasMany(News::class, 'id_customer', 'id');
    }
}
