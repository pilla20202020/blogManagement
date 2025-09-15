<?php

namespace App\Services;

use App\Repositories\BlogRepository;

class BlogService
{
    protected $repo;

    public function __construct(BlogRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listPaginated(int $perPage = 10)
    {
        return $this->repo->allPaginated($perPage);
    }

    public function get(int $id)
    {
        return $this->repo->find($id);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $blog = $this->repo->find($id);
        if (!$blog) {
            return false;
        }

        $user = auth('api')->user();

        if ($user->role !== 'admin' && $blog->user_id !== $user->id) {
            throw new \Exception('You are not authorized to delete this blog');
        }

        return $this->repo->delete($id);
    }
}
