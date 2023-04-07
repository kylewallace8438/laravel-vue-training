<?php

namespace App\Repositories;

interface RoleRepositoryInterface extends AbstractRepositoryInterface
{
    public function getRoleType();
    public function getRoleByType($type);
    public function getRole($type, $action);
    // public function create(array $attributes, $type);
}