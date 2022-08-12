<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function list()
    {
        $roles = Role::select('roles.*')->get();
        return view('admin.role.list', [
            'roles' => $roles
        ]);
    }

    public function addForm()
    {
        return view('admin.role.add');
    }

    public function postAdd(RoleRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return redirect()->route('admin.role.list');
    }

    public function delete(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.role.list');
    }

    public function updateForm(Role $role)
    {
        return view('admin.role.update', [
            'role' => $role
        ]);
    }

    public function putUpdate(Role $role, RoleRequest $request)
    {
        $role->name = $request->name;
        $role->save();
        return redirect()->route('admin.role.list');
    }
}
