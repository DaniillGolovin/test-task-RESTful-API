<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $usersArray = $this->userService->getAllUsers();

        return UserResource::collection($usersArray);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \App\Http\Resources\UserResource
     */
    public function show($id)
    {
        $this->authorize('view', User::class);
        $user = $this->userService->getUserById($id);

        return UserResource::make($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUserRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
 */
    public function store(CreateUserRequest$request)
    {
        $this->authorize('create', User::class);
        $user = $this->userService->createUser($request->validated());

        return response()->json(UserResource::make($user), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  int  $id
     *
     * @return \App\Http\Resources\UserResource
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $this->authorize('update', User::class);
        $updatedUser = $this->userService->updateUser($request->validated(), $id);

        return UserResource::make($updatedUser);
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
        $this->authorize('delete', User::class);
        $isUserDelete = $this->userService->deleteUser($id);

        return $isUserDelete ?
            response()->json(null, 204) :
            response()->json(['error' => 'The resource you are trying to delete is no longer available.'], 410);
    }
}
