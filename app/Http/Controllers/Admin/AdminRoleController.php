<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        if(Auth::user()->role_user == 0){
            return view('admin.role', compact('roles'));
        } else{
            return redirect()->back();
        }
        
    }

    public function create(Request $request)
    {
        $type = $request->get('role_type');
        $check = Role::where('type', $type)->first();
        if($check != null){
            return redirect()->back();
        }
        $actions = ['View', 'Create', 'Update', 'Delete'];
        $admins = User::where('role_user', 1)->get();
        foreach ($actions as $action) {
            $role = Role::create([
                'type' => $type,
                'action' => $action,
            ]);
            foreach ($admins as $admin) {
                AdminRole::create(['admin_id' => $admin->id, 'role_id' => $role->id]);
            }
        }
        return redirect()->back();
    }

    public function profile($id)
    {
        $roles = AdminRole::where('admin_id', $id)->get();
        $types = Role::latest()->groupBy('type')->get('type');
        $actions = ['View', 'Create', 'Update', 'Delete'];
        $admin = User::find($id);
        // dd($role);
        return view('admin.profile_admin', compact('admin', 'roles', 'types', 'actions'));
    }

    public function update(Request $request, $id)
    {
        AdminRole::where('admin_id', $id)->update(['status' => 0]);
        $roles = $request->get('role');
        if ($roles != null) {
            foreach ($roles as $role) {
                $type =  explode('-', $role);
                $role_id = Role::where('type', $type[0])->where('action', $type[1])->first();
                $admin_role = AdminRole::where('admin_id', $id)->where('role_id', $role_id?->id)->first();
                if ($admin_role?->status == 0) {
                    AdminRole::where('admin_id', $id)->where('role_id', $role_id?->id)->update(['status' => 1]);
                }
            }
        }
        return redirect()->back();
    }
}
