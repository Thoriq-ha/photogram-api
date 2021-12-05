<?php
namespace App\Interfaces;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;

interface UserRepositoryInterface {
    public function getAllUser();
    public function getUserById(User $user);
    public function createUser(CreateUserRequest $request);
    public function updateUser(UpdateUserRequest $request, User $user);
    public function deleteUser(User $user);
}
