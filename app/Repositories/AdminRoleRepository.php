<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\AdminRole;

class AdminRoleRepository implements AdminRoleRepositoryInterface
{
    public function updateStatusToFalse($admin_id)
    {
        AdminRole::where('admin_id', $admin_id)->update(['status' => 0]);
    }

    public function getAdminRole($admin_id, $role_id)
    {
        return AdminRole::where('admin_id', $admin_id)->where('role_id', $role_id)->first();
    }

    public function show()
    {
        return;
    }
    public function create(array $attributes)
    {
        return AdminRole::create($attributes);
    }
    public function getById($id)
    {
        return AdminRole::where('admin_id', $id)->get();
    }
    public function update($id, array $attributes)
    {
        $adminRole = AdminRole::find($id);
        $adminRole->update($attributes);
        return $adminRole;
    }
    public function delete($id)
    {
        $adminRole = AdminRole::find($id);
        $adminRole->delete();
    }
}
