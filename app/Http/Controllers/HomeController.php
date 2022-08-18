<?php

namespace App\Http\Controllers;

use App\User;
use App\Roles;
use App\Project;
use App\BoCompany;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = User::with('user_roles.roles')->where('id', auth()->user()->id)->first();
        $projects = Project::with('attachment', 'contact', 'bo_companies')->get();

        $buyouts = BoCompany::with('user', 'payments', 'project')->orderBy('total_amt', 'DESC')->get();
        // dd($buyouts);

        return view('layouts.dashboard', ['projects' => $projects, 'user' => $user, 'buyouts' => $buyouts]);
    }
}
