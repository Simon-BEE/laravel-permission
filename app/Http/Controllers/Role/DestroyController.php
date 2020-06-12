<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;

class DestroyController extends Controller
{
    public function __invoke(Role $role)
    {
        $role->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Role has been removed.',
        ]);
    }
}
