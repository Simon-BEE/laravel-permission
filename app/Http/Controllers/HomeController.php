<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::all()->first();
        // dd($user->removePermissionsTo('create-tasks', 'edit-tasks', 'edit-users'));
        dd(auth()->user()->giveRolesTo('manager'));

        return view('home');
    }
}
