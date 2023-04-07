<?php

namespace App\Repositories;

interface ProductRepositoryInterface extends AbstractRepositoryInterface
{
    public function getByName($name);
}
