<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\Role;
use App\Models\User;
use App\Repositories\AdminRoleRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    protected $roleRepository;
    protected $adminRoleRepository;
    protected $userRepository;

    public function __construct(RoleRepository $roleRepository, AdminRoleRepository $adminRoleRepository, UserRepository $userRepository )
    {
        $this->roleRepository = $roleRepository;
        $this->adminRoleRepository = $adminRoleRepository;
        $this->userRepository = $userRepository;
    }


    public function formRegister()
    {
        if (Auth::user()->role_user == 0) {
            return view('admin.register');
        } else {
            return redirect()->back();
        }
    }

    public function register(Request $request)
    {
        $account = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_user' => 1,
        ];

        $user = $this->userRepository->create($account);



        $roles = $this->roleRepository->show();
        for ($i = 1; $i <= count($roles); $i++) {
            $admin_role = [
                'admin_id' => $user->id,
                'role_id' => $i,
            ];
            $this->adminRoleRepository->create($admin_role);
        }

        return redirect('/admin/register');
    }
}