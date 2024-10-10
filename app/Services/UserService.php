<?php

namespace App\Services;

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
        return $this->userRepository->getAll();
    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->find($id);
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function updateUser(array $data, int $id): User
    {
        $userById = $this->userRepository->find($id);
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->update($userById, $data);
    }

    public function deleteUser(int $id): ?bool
    {
        return $this->userRepository->delete($id);
    }
}
