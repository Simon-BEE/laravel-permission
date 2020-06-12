<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class DestroyController extends Controller
{
    public function __invoke(Permission $permission)
    {
        $permission->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Permission has been removed.',
        ]);
    }
}
