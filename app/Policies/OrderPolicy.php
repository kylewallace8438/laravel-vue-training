<?php

namespace App\Policies;

use App\Models\AdminRole;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\Repositories\AdminRoleRepository;
use App\Repositories\RoleRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    protected $roleRepository;
    protected $adminRoleRepository;

    public function __construct(RoleRepository $roleRepository, AdminRoleRepository $adminRoleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->adminRoleRepository = $adminRoleRepository;
    }


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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        $role_id = $this->roleRepository->getRole('Order', 'View');
        $status = $this->adminRoleRepository->getAdminRole($user->id, $role_id?->id);
        if ($status?->status == 1 || $user->role_user == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function confirm(User $user)
    {
        $role_id = $this->roleRepository->getRole('Order', 'Update');
        $status = $this->adminRoleRepository->getAdminRole($user->id, $role_id?->id);
        if ($status?->status == 1 || $user->role_user == 0) {
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
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        $role_id = $this->roleRepository->getRole('Order', 'Delete');
        $status = $this->adminRoleRepository->getAdminRole($user->id, $role_id?->id);
        if ($status?->status == 1 || $user->role_user == 0) {
            return true;
        } else {
            return false;
            // return redirect()->route('orders.list')->with('error','You have no role');
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Order $order)
    {
        //
    }
}
