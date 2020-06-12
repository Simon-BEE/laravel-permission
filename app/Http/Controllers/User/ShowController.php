<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
class ShowController extends Controller
{
    public function __invoke(User $user)
    {
        $user->load(['permissions', 'roles']);

        return view('users.show', [
            'user' => $user,
        ]);
    }
}
