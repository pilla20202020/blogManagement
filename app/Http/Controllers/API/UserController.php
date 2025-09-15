<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ApiResponse;

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAll();
        return $this->successResponse($users, 'Users fetched successfully');
    }

    public function store(UserStoreRequest $request)
    {
        $user = $this->userService->create($request->validated());
        return $this->successResponse($user, 'User created successfully', 201);
    }

    public function show(int $id)
    {
        $user = $this->userService->findById($id);
        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }
        return $this->successResponse($user, 'User fetched successfully');
    }

    public function update(UserUpdateRequest $request, int $id)
    {
        $user = $this->userService->update($id, $request->validated());
        if (!$user) {
            return $this->errorResponse('User not found or update failed', 404);
        }
        return $this->successResponse($user, 'User updated successfully');
    }

    public function destroy(int $id)
    {
        try {
            $this->userService->delete($id);
            return $this->successResponse(null, 'User deleted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 403);
        }
    }
}
