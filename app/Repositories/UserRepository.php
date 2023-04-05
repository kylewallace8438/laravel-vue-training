<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository implements AbstractRepositoryInterface
{
    public function show()
    {
        return User::all();
    }
    public function create(array $attributes)
    {
        return User::create($attributes);
    }
    public function getById($id)
    {
        return User::find($id);
    }
    public function update($id, array $attributes)
    {
        $user = User::find($id);
        $user->update($attributes);
        return $user;
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
