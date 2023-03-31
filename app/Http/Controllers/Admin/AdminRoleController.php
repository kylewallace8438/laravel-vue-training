<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function profile($id)
    {
        $roles = AdminRole::where('admin_id', $id)->get();
        $admin = User::find($id);
        // dd($role);
        return view('admin.profile_admin', compact('admin','roles'));
    }

    public function update(Request $request, $id)
    {
        AdminRole::where('admin_id', $id)->update(['status' => 0]);
        $roles = $request->get('role');
        if ($roles != null) {
            foreach ($roles as $role) {
                $type =  explode('-', $role);
                $role_id = Role::where('type', $type[0])->where('action', $type[1])->first();
                $admin_role = AdminRole::where('admin_id', $id)->where('role_id', $role_id->id)->first();
                if ($admin_role->status == 0) {
                    AdminRole::where('admin_id', $id)->where('role_id', $role_id->id)->update(['status' => 1]);
                }
            }
        }
        return redirect()->back();
    }
}
