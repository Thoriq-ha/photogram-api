<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository )
    {
        $this->userRepository = $userRepository;

        $this->middleware('auth:sanctum')->only(['update','destroy']);
    }
    
    public function index(): JsonResponse
    {
        $users = $this->userRepository->getAllUser();
        return $this->successResponse(
            $users,
            "Users data successfully fetched"
        );
    }
    
    public function store(CreateUserRequest $request): JsonResponse
    {        

        $createUser = $this->userRepository->createUser($request);
        return $this->successResponse(
            $createUser,
            "User Successfully created"
        );
    }

    public function show(User $user) : JsonResponse
    {
        $user = $this->userRepository->getUserById($user);
        return $this->successResponse(
            $user,
            "User with id: {$user->id} successfully fetched"
        );
    }

    public function update(UpdateUserRequest $request, User $user) :JsonResponse
    {
        return $this->successResponse(
            $this->userRepository->updateUser($request, $user),
            "User with id: {$user->id} successfully updated"
        );
    }

   
    public function destroy(DeleteUserRequest $request,User $user)
    {
        $tmp_id = $user->id;
        return $this->successResponse(
            $this->userRepository->deleteUser($user),
            "User with id: {$tmp_id} successfully deleted"
        );
    }
}
