<?php

namespace App\Http\Controllers\Permission;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;

class EditController extends Controller
{
    public function edit(Permission $permission)
    {
        $permission->load(['roles']);

        $permission->setPermissionToAdmin();

        return view('permissions.edit', [
            'permission' => $permission,
            'roles' => Role::allWithoutAdmin(),
        ]);
    }

    /**
     * @param StorePermissionRequest $request
     * @param Role $role
     * @return void
     */
    public function update(StorePermissionRequest $request ,Permission $permission)
    {
        $validateData = $request->validated();

        $validateData['slug'] = Str::slug($validateData['slug']);

        $permission->update($validateData);

        // Reset all roles
        $permission->roles()->detach();
        if (isset($validateData['roles'])) {
            foreach ($validateData['roles'] as $role) {
                if (!$permission->hasRole($role)) {
                    $permission->roles()->attach($role);
                }
            }
        }

        $permission->setPermissionToAdmin();

        return redirect()->route('permissions.index')->with([
            'type' => 'success',
            'message' => "{$permission->name} has been edited."
        ]);
    }
}
