<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getRole($type, $action)
    {
        return Role::where('type', $type)->where('action', $action)->first();
    }

    public function getRoleByType($type)
    {
        return Role::where('type', $type)->first();
    }

    public function getRoleType()
    {
        return Role::groupBy('type')->get('type');
    }
    public function show()
    {
        return Role::all();
    }
    public function create(array $attributes)
    {
        return Role::create($attributes);
    }
    public function getById($id)
    {
        return Role::find($id);
    }
    public function update($id, array $attributes)
    {
        $role = Role::find($id);
        $role->update($attributes);
        return $role;
    }
    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();
    }
}
