<?php

namespace App\Http\Controllers\Permission;

use App\Models\Role;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Models\Permission;

class CreateController extends Controller
{
    public function create()
    {
        return view('permissions.create', [
            'roles' => Role::allWithoutAdmin(),
        ]);
    }

    public function store(StorePermissionRequest $request)
    {
        $validateData = $request->validated();

        $validateData['slug'] = Str::slug($validateData['slug']);

        $permission = Permission::create($validateData);
        if (isset($validateData['roles'])) {
            $permission->roles()->attach($validateData['roles']);
        }

        return redirect()->route('permissions.index')->with([
            'type' => 'success',
            'message' => 'A permission has been created.'
        ]);
    }
}
