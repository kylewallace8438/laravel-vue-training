<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role_user', 2)->get();
        return view('admin.customer', compact('customers'));
    }

    public function show(User $user)
    {
        $this->authorize('view',User::class);
        return redirect()->back();
    }
}
