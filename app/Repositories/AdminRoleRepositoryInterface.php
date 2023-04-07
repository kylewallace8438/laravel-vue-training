<?php

namespace App\Repositories;

interface AdminRoleRepositoryInterface extends AbstractRepositoryInterface
{
    public function updateStatusToFalse($admin_id);
    public function getAdminRole($admin_id, $role_id);
}