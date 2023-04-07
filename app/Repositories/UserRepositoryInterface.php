<?php

namespace App\Repositories;

interface UserRepositoryInterface extends AbstractRepositoryInterface
{
    public function getByRole($id);
    public function getByName($name);

}
