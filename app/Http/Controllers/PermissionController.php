<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return Permission::all();
    }

    public function store(Request $request)
    {
        $Permission = Permission::create($request->all());

        return response()->json($Permission, 201);
    }

    public function show($id)
    {
        $Permission = Permission::find($id);

        if (!$Permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        return $Permission;
    }

    public function update(Request $request, $id)
    {
        $Permission = Permission::find($id);

        if (!$Permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $Permission->update($request->all());

        return response()->json($Permission, 200);
    }

    public function destroy($id)
    {
        $Permission = Permission::find($id);

        if (!$Permission) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        $Permission->delete();

        return response()->json(['message' => 'Permission deleted'], 204);
    }
}

