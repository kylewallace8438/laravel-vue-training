<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\AdminRoleRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function form_login()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role_user' => 1]) || Auth::attempt(['email' => $email, 'password' => $password, 'role_user' => 0])) {
            return redirect('admin');
        } else {
            return redirect('admin/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
