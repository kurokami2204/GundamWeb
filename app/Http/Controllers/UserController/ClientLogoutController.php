<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientLogoutController extends Controller
{
    public function store(){
        auth('customer')->logout();
        return redirect()->route('client.home');
    }
}
