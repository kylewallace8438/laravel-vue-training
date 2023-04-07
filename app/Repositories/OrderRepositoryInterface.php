<?php

namespace App\Repositories;

interface ProductRepositoryInterface extends AbstractRepositoryInterface
{
    public function getByStatus($status);
}
