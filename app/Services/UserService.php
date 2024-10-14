<?php

namespace App\Services;

use App\Events\UserRegistered;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return cache()->remember('users:all', 60 * 60, function () {
            return $this->userRepository->getAll();
        });
    }

    public function getUserById(int $id): User
    {
        return cache()->remember("user:{$id}", 60 * 60, function () use ($id) {
            return $this->userRepository->find($id);
        });
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        event(new UserRegistered($user));

        cache()->forget('users:all');

        return $user;
    }

    public function updateUser(array $data, int $id): User
    {
        $userById = $this->userRepository->find($id);
        $data['password'] = Hash::make($data['password']);

        cache()->forget("user:{$id}");
        cache()->forget('users:all');

        return $this->userRepository->update($userById, $data);
    }

    public function deleteUser(int $id): ?bool
    {
        $result = $this->userRepository->delete($id);

        if ($result) {
            cache()->forget("user:{$id}");
            cache()->forget('users:all');
        }

        return $result;
    }
}
