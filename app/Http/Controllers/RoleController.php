<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    function store(Request $request)
    {
        $validateData = $request->validate(['name' => 'required|string', 'code' => 'required|string']);

        $role = Role::create($validateData);

        return response()->json($role, 201);
    }

    function show(Role $role)
    {
        return response()->json($role);
    }

    function update(Request $request, Role $role)
    {
        $validateData = $request->validate(['name' => 'required|string', 'code' => 'required|string']);

        $role->update($validateData);

        return response()->json($role, 200);
    }
    function destroy(Role $role)
    {
        $role->delete();
        return response()->json(null, 204);
    }
}
