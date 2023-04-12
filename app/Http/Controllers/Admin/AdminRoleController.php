<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\Role;
use App\Models\User;
use App\Repositories\AdminRoleRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRoleController extends Controller
{

    protected $roleRepository;
    protected $adminRoleRepository;
    protected $userRepository;


    public function __construct(RoleRepository $roleRepository, AdminRoleRepository $adminRoleRepository, UserRepository $userRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->adminRoleRepository = $adminRoleRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->show();
        if (Auth::user()->role_user == 0) {
            return view('admin.role', compact('roles'));
        } else {
            return redirect()->back();
        }
    }

    public function create(Request $request)
    {
        $type = $request->get('role_type');
        $check = $this->roleRepository->getRoleByType($type);
        if ($check != null) {
            return redirect()->back();
        }
        $actions = ['View', 'Create', 'Update', 'Delete'];
        $admins = $this->userRepository->getByRole(1);
        foreach ($actions as $action) {
            $role_type = [
                'action' => $action, 
                'type' => $type
            ];
            $role = $this->roleRepository->create($role_type);
            foreach ($admins as $admin) {
                $admin_role = ['admin_id' => $admin->id, 'role_id' => $role->id];
                $this->adminRoleRepository->create($admin_role);
            }
        }
        return redirect()->back();
    }

    public function profile($id)
    {
        $roles = $this->adminRoleRepository->getById($id);
        $types = $this->roleRepository->getRoleType();
        $actions = ['View', 'Create', 'Update', 'Delete'];
        $admin = $this->userRepository->getById($id);
        return view('admin.profile_admin', compact('admin', 'roles', 'types', 'actions'));
    }

    public function update(Request $request, $id)
    {
        $this->adminRoleRepository->updateStatusToFalse($id);
        $roles = $request->get('role');
        if ($roles != null) {
            foreach ($roles as $role) {
                $type =  explode('-', $role);
                $role_id = $this->roleRepository->getRole($type[0],$type[1]);
                $admin_role = $this->adminRoleRepository->getAdminRole($id, $role_id->id);

                if ($admin_role?->status == 0) {
                    $admin_role->update(['status' => 1]);
                }
            }
        }
        return redirect()->back();
    }
}
