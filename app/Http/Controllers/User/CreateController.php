<?php

namespace App\Http\Controllers\User;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Repository\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;

class CreateController extends Controller
{
    public function create()
    {
        return view('users.create', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }

    public function store(StoreUserRequest $request, UserRepository $userRepository)
    {
        $validateData = $request->validated();

        $user = User::create($validateData);

        $user = $userRepository->setRolesRelationship($user, $validateData['roles']);

        $user->givePermissionsThroughRole();

        if (isset($validateData['permissions']) && !empty($validateData['permissions'])) {
            $userRepository->setPermissionsRelationship($user, $validateData['permissions']);
        }

        return redirect()->route('users.index')->with([
            'type' => 'success',
            'message' => 'A user has been created.'
        ]);
    }
}
