<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, HasRoles;
    protected $guard = 'admins';
    protected $fillable = [
        'username',
        'password',
        'name',
        'phone_number',
        'linkImg'
    ];
    protected $hidden = [
        'password',
        'remember_token'
    ];
    protected $dates = ['created_at', 'updated_at'];
    protected $table = 'admin';
}
