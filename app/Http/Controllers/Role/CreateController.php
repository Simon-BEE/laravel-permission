<?php

namespace App\Http\Controllers\Role;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;

class CreateController extends Controller
{
    public function create()
    {
        return view('roles.create', [
            'permissions' => Permission::all(),
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        $validateData = $request->validated();

        $validateData['slug'] = Str::slug($validateData['slug']);

        $role = Role::create($validateData);
        if (isset($validateData['permissions'])) {
            $role->permissions()->attach($validateData['permissions']);
        }

        return redirect()->route('roles.index')->with([
            'type' => 'success',
            'message' => 'A role has been created.'
        ]);
    }
}
