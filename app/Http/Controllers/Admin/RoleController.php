<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $types = Role::groupBy('type')->get('type');
        return view('admin.role',compact('types'));
    }
}
