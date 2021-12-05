<?php
namespace App\Repositories;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface {
    public function getAllUser()
    {
        return User::all();
    }

    public function getUserById(User $user)
    {
        return User::with(['posts'])->findOrFail($user->id);
    }

    public function createUser(CreateUserRequest $request)
    {
        $user = User::create($request->all());

        $user->password = Hash::make($request->password);
        $user->save();
        return $user;
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {
        User::whereId($user->id)->update($request->all());
        return User::whereId($user->id)->first();
    }

    public function deleteUser(User $user)
    {
        User::destroy($user->id);
    }
}