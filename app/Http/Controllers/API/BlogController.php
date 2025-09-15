<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Services\BlogService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use ApiResponse;

    protected BlogService $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        $blogs = $this->service->listPaginated($perPage);
        return $this->successResponse($blogs, 'Blogs fetched successfully');
    }

    public function show(int $id)
    {
        $blog = $this->service->get($id);
        if (!$blog) {
            return $this->errorResponse('Blog not found', 404);
        }
        return $this->successResponse($blog, 'Blog details fetched');
    }

    public function store(BlogStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('api')->id();
        $data['slug'] = Str::slug($data['title']) . '-' . time();

        $blog = $this->service->create($data);
        return $this->successResponse($blog, 'Blog created successfully', 201);
    }

    public function update(BlogUpdateRequest $request, int $id)
    {
        $data = $request->validated();

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . time();
        }

        $blog = $this->service->update($id, $data);
        if (!$blog) {
            return $this->errorResponse('Blog not found or update failed', 404);
        }

        return $this->successResponse($blog, 'Blog updated successfully');
    }

    public function destroy(int $id)
    {
        try {
            $deleted = $this->service->delete($id);

            if (!$deleted) {
                return $this->errorResponse('Blog not found', 404);
            }

            return $this->successResponse(null, 'Blog deleted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 403);
        }
    }
}
