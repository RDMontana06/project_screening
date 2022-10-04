<?php

namespace App\Http\Controllers;

use App\User;
use App\Roles;
use App\UserRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Alert;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('user_roles.roles')->get();
        $roles = Roles::all();
        return view('user.index', array(
            'users' => $users,
            'roles' => $roles
        ));
    }
    public function save(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'name' => 'required', 'string', 'max:255',
            'email' => 'unique:users,email|required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:6', 'confirmed',
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($request->role) {
            foreach ($request->role as $key => $role) {
                $userRole = new UserRoles;
                $userRole->user_id = $user->id;
                $userRole->role_id = $role;
                $userRole->save();
            }
        }

        Alert::success('Successfully Created')->persistent('Dismiss');

        return back();
    }
    public function update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'role' => 'required',
        ]);
        if ($request->role) {
            $userRoleDel = UserRoles::where('user_id', $id)->delete();
            foreach ($request->role as $key => $role) {
                $userRole = new UserRoles;
                $userRole->user_id = $id;
                $userRole->role_id = $role;
                $userRole->save();
            }
        }

        $user =  User::findOrFail($id);
        $user->name = $request->name;
        $user->save();

        Alert::success('User Updated', 'Successfully Updated')->persistent('Dismiss');;
        return redirect('user');
    }
    public function disable($id)
    {
        User::Where('id', $id)->update(['status' => 0]);
        return back();
    }
    public function enable($id)
    {
        User::Where('id', $id)->update(['status' => 1]);
        return back();
    }
    public function reset(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user =  User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();

        Alert::success('Changed', 'Change Successfully')->persistent('Dismiss');
        return back();
    }
}
