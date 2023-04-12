<?php
namespace App\Repositories;

use App\Models\Rank;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
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
    public function getByRole($id)
    {
        $users = User::where('role_user', $id)->get();
        return $users;
    }
    public function getByName($name)
    {
        $user = User::where('name', $name)->first();
        return $user;
    }

    public function getRankbyId($id){
        $user = User::find($id);
        $rank_point = $user->rank_point;
        $rank_name = "";
        if ($rank_point < 500) {
            $rank_name = "No rank";
        }
        else
        {
            $ranks = Rank::all();
            foreach ($ranks as $rank) {
                if ($rank_point > $rank->point) {
                    $rank_name = $rank->rank;
    
                }
            }
        }
        return $rank_name;

    
    }
}
