<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'bankName',
        'userName',
        'department',
        'bankNumber'
    ];
    
    protected $table = 'bankaccount';
    public $timestamps = false;
}
