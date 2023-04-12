<?php
namespace App\Repositories;

interface AbstractRepositoryInterface
{
    public function show();
    public function create(array $attributes);
    public function getById($id);
    public function update($id, array $attributes);
    public function delete($id);
}
