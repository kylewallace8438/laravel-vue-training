<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function profile($id)
    {
        return view('admin.profile_admin');
    }
}
