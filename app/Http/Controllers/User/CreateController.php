<?php

namespace App\Http\Controllers\User;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class CreateController extends Controller
{
    public function create()
    {
        return view('users.create', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $validateData = $request->validated();

        $user = User::create($validateData);

        if (in_array('admin' , $validateData['roles'])) {
            $user->roles()->sync(Role::where('slug', 'admin')->first());
        }else{
            $user->giveRolesTo($validateData['roles']);
            $user->load('roles');
        }

        $user->givePermissionsThroughRole();
        $user->load('permissions');

        if (isset($validateData['permissions']) && !empty($validateData['permissions'])) {
            $user->givePermissionsTo($validateData['permissions']);
        }

        return redirect()->route('users.index')->with([
            'type' => 'success',
            'message' => 'A user has been created.'
        ]);
    }
}
