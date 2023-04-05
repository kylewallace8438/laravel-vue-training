<?php

namespace App\Policies;

use App\Models\AdminRole;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        $role_id = Role::where('type','Product')->where('action','View')->first();
        $status = AdminRole::where('admin_id',$user->id)->where('role_id',$role_id?->id)->first();
        if($status?->status == 1 || $user->role_user == 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function add(User $user)
    {
        $role_id = Role::where('type','Product')->where('action','Create')->first();
        $status = AdminRole::where('admin_id',$user->id)->where('role_id',$role_id?->id)->first();
        if($status?->status == 1 || $user->role_user == 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        $role_id = Role::where('type','Product')->where('action','Update')->first();
        $status = AdminRole::where('admin_id',$user->id)->where('role_id',$role_id?->id)->first();
        if($status?->status == 1 || $user->role_user == 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        $role_id = Role::where('type','Product')->where('action','Delete')->first();
        $status = AdminRole::where('admin_id',$user->id)->where('role_id',$role_id?->id)->first();
        if($status?->status == 1 || $user->role_user == 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
