<?php

namespace App\Http\Controllers;

use App\Http\Requests\addAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function list()
    {
        $users = User::join('roles', 'users.role_id', 'roles.id')
            ->select('users.*', 'roles.name as roleName')
            /* ->where('role_id','!=', '1') */
            ->get();
        return view('admin.user.list', [
            'users' => $users
        ]);
    }

    public function changeStatus(User $user)
    {
        if ($user->role_id == 1 || $user->role_id == 2) {
            return redirect()->route('admin.user.list');
        }
        if ($user->status == 0) {
            $user->status = 1;
        } else $user->status = 0;
        $user->save();
        return redirect()->route('admin.user.list');
    }

    public function delete(User $user)
    {
        if ($user->role_id == 1 || $user->role_id == 2) {
            return redirect()->route('admin.user.list');
        }
        $user->delete();
        return redirect()->route('admin.user.list');
    }
    public function addForm()
    {
        return view('admin.user.add');
    }
    public function postAdd(addAdminRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->status = 1;
        $user->role_id = 2;
        $user->password = '$2a$12$igxR/sjaI8cyhPnEZiyQGer9WMoxq9/EO/q14yH63CRkv.kKUay8y';
        $user->avatar = 'images/users/NgszeyUUlBQpKIGjzOlfgRC1CFYDaBM0WKXbVftW.png';
        $user->save();
        return redirect()->route('admin.user.list');
    }
}
