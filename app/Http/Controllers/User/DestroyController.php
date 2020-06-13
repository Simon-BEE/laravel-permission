<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class DestroyController extends Controller
{
    public function __invoke(User $user)
    {
        abort_if($user->hasRole('admin'), 403, 'You can\'t remove an admin.');

        $user->delete();

        return redirect()->route('users.index')->with([
            'type' => 'success',
            'message' => 'A user has been removed.'
        ]);
    }
}
