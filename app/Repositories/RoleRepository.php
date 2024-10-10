<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find(int $id): Role
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Role
    {
        return $this->model->create($data);
    }

    public function update(Role $user, array $data): Role
    {
        $user->update($data);
        return $user;
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }
}
