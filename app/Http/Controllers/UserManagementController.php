<?php

namespace App\Http\Controllers;

use app\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', [
            'users' => $users
        ]);
    }
}
