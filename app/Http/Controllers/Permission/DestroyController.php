<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class DestroyController extends Controller
{
    public function __invoke(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with([
            'type' => 'success',
            'message' => 'Permission has been removed.',
        ]);
    }
}
