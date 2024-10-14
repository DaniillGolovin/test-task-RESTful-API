<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRoles()
    {
        return cache()->remember('roles:all', 60 * 60, function () {
            return $this->roleRepository->getAll();
        });
    }

    public function getRoleById(int $id): Role
    {
        return cache()->remember("role:{$id}", 60 * 60, function () use ($id) {
            return $this->roleRepository->find($id);
        });
    }

    public function createRole(array $data): Role
    {
        cache()->forget('roles:all');

        return $this->roleRepository->create($data);
    }

    public function updateRole(array $data, int $id): Role
    {
        $roleById = $this->roleRepository->find($id);

        cache()->forget("role:{$id}");
        cache()->forget('roles:all');

        return $this->roleRepository->update($roleById, $data);
    }

    public function deleteRole(int $id): ?bool
    {
        $result = $this->roleRepository->delete($id);

        if ($result) {
            cache()->forget("role:{$id}");
            cache()->forget('roles:all');
        }

        return $result;
    }
}
