<?php

namespace App\Http\Controllers;

use App\Roles;
use Illuminate\Http\Request;
use App\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = User::with('user_roles.roles')->where('id', auth()->user()->id)->first();
        return view('layouts.dashboard', ['user' => $user]);
    }
}
