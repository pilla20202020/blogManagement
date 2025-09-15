<?php


namespace App\Interfaces;


interface BlogRepositoryInterface
{
    public function allPaginated(int $perPage = 10);
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
