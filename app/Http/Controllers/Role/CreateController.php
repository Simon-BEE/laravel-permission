<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function create()
    {
        return view('roles.create', [
            'permissions' => Permission::all(),
        ]);
    }

    public function store()
    {
        dd(request()->all());
    }
}
