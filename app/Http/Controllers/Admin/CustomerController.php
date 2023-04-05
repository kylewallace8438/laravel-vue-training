<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role_user', 2)->get();
        return view('admin.customer', compact('customers'));
    }

    public function show(Request $request)
    {
        if ($request->user()->can('view', User::class)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Access is not allowed');
        }
    }
}
