<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Interfaces\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    public function allPaginated(int $perPage = 10)
    {
        return Blog::with('user')->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function find(int $id)
    {
        return Blog::with('user')->find($id);
    }


    public function create(array $data)
    {
        return Blog::create($data);
    }


    public function update(int $id, array $data)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($data);
        return $blog;
    }


    public function delete(int $id)
    {
        $blog = Blog::findOrFail($id);
        return $blog->delete();
    }
}
