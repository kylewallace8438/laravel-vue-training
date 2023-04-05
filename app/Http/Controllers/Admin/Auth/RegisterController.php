<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function form_register()
    {
        if(Auth::user()->role_user == 0){
            return view('admin.register');
        } else{
            return redirect()->back();
        }
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_user' => 1,
        ]);

        $roles = Role::all();
        for ($i=1; $i <= count($roles) ; $i++) { 
            AdminRole::create([
                'admin_id' => $user->id,
                'role_id' => $i,
            ]);
        }

        return redirect('/admin/register');
    }
}
