<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('admin:generate', function () {
    $name = $this->ask('Name?');
    $email = $this->ask('Email?');
    $pwd = $this->secret('Password?');

    $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($pwd),
        ]);
    $user->roles()->attach(Role::where('slug', 'admin')->first());

    $this->info('Admin account created for '.$name);
})->describe('Generate a user with admin rights');
