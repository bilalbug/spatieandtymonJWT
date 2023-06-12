<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
//        $User = User::create(['username']);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            // 'user_role'=>$request->user_role
        ]);
        $role = $request->user_role;
        $user->assignRole($role);
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $User;
    }

    public function update(Request $request, $id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $User->update($request->all());

        return response()->json($User, 200);
    }

    public function destroy($id)
    {
        $User = User::find($id);

        if (!$User) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $User->delete();

        return response()->json(['message' => 'User deleted'], 204);
    }
}
