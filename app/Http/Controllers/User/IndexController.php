<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        // dd(auth()->id());
        // dd($this->authorize('update', User::find(2)));

        return view('users.index', [
            'users' => User::with('roles')->get(),
        ]);
    }
}
