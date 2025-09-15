<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::paginate(10);
    }

    public function find(int $id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function delete(int $id)
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }
        return $user->delete();
    }
}
