<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function profile($id)
    {
        // dd($id);
        $admin = User::find($id);
        return view('admin.profile_admin', compact('admin'));
    }
}
