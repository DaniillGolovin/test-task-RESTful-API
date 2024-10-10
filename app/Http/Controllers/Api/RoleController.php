<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        $rolesArray = $this->roleService->getAllRoles();

        return RoleResource::collection($rolesArray);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \App\Http\Resources\RoleResource
     */
    public function show($id)
    {
        $this->authorize('view', Role::class);
        $role = $this->roleService->getRoleById($id);

        return RoleResource::make($role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateRoleRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRoleRequest $request)
    {
        $this->authorize('create', Role::class);
        $role = $this->roleService->createRole($request->validated());

        return response()->json(RoleResource::make($role), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  int  $id
     *
     * @return \App\Http\Resources\RoleResource
     */
    public function update(UpdateRoleRequest $request, int $id)
    {
        $this->authorize('update', Role::class);
        $updatedRole = $this->roleService->updateRole($request->validated(), $id);

        return RoleResource::make($updatedRole);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $this->authorize('delete', Role::class);
        $isRoleDelete = $this->roleService->deleteRole($id);

        return $isRoleDelete ?
            response()->json(null, 204) :
            response()->json(['error' => 'The resource you are trying to delete is no longer available.'], 410);
    }
}
