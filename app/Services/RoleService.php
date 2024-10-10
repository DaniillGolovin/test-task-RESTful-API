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
        return $this->roleRepository->getAll();
    }

    public function getRoleById(int $id): Role
    {
        return $this->roleRepository->find($id);
    }

    public function createRole(array $data): Role
    {
        return $this->roleRepository->create($data);
    }

    public function updateRole(array $data, int $id): Role
    {
        $userById = $this->roleRepository->find($id);

        return $this->roleRepository->update($userById, $data);
    }

    public function deleteRole(int $id): ?bool
    {
        return $this->roleRepository->delete($id);
    }
}
