<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;

class DestroyController extends Controller
{
    public function __invoke(Role $role)
    {
        if ($role->slug === 'admin') {
            abort(403, 'This role can\'t be removed.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with([
            'type' => 'success',
            'message' => 'Role has been removed.',
        ]);
    }
}
