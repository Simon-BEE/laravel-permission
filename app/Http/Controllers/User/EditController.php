<?php

namespace App\Http\Controllers\User;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Repository\UserRepository;

class EditController extends Controller
{
    //Rule::unique('users', 'email')->ignore($this->userId)

    public function edit(User $user)
    {
        $user->load(['permissions', 'roles']);

        return view('users.edit', [
            'user' => $user,
            'permissions' => Permission::all(),
            'roles' => Role::all(),
        ]);
    }

    public function update(UpdateUserRequest $request, UserRepository $userRepository, User $user)
    {
        $validateData = $request->validated();

        $user->update($validateData);

        if (auth()->user()->hasRoles('admin')) {
            $userRepository->resetAuthRelationship($user);

            $user = $userRepository->setRolesRelationship($user, $validateData['roles']);

            $user->givePermissionsThroughRole();

            if (isset($validateData['permissions']) && !empty($validateData['permissions'])) {
                $userRepository->setPermissionsRelationship($user, $validateData['permissions']);
            }
        }

        return redirect()->route('users.index')->with([
            'type' => 'success',
            'message' => "{$user->name} has been edited."
        ]);
    }
}
