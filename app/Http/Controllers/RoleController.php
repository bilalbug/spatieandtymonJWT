<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function store(Request $request)
    {
        $Role = Role::create($request->all());

        return response()->json($Role, 201);
    }

    public function show($id)
    {
        $Role = Role::find($id);

        if (!$Role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return $Role;
    }

    public function update(Request $request, $id)
    {
        $Role = Role::find($id);

        if (!$Role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $Role->update($request->all());

        return response()->json($Role, 200);
    }

    public function destroy($id)
    {
        $Role = Role::find($id);

        if (!$Role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $Role->delete();

        return response()->json(['message' => 'Role deleted'], 204);
    }
}
