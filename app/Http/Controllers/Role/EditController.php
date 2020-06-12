<?php

namespace App\Http\Controllers\Role;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;

class EditController extends Controller
{
    public function edit(Role $role)
    {
        $role->load(['permissions']);

        return view('roles.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * @param StoreRoleRequest $request
     * @param Role $role
     * @return void
     */
    public function update(StoreRoleRequest $request ,Role $role)
    {
        $validateData = $request->validated();

        $validateData['slug'] = Str::slug($validateData['slug']);

        $role->update($validateData);

        // Reset all permissions
        $role->permissions()->detach();
        if (isset($validateData['permissions'])) {
            foreach ($validateData['permissions'] as $permission) {
                if (!$role->hasPermission($permission)) {
                    $role->permissions()->attach($permission);
                }
            }
        }

        return redirect()->route('roles.index')->with([
            'type' => 'success',
            'message' => "{$role->name} has been edited."
        ]);
    }
}
