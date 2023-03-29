<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function show(){
        $customer = User::where('role_user',2)->get();
        dd($customer);
    }
}
