<?php

namespace App\Http\Controllers\Api\Super;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(
            User::select('id','nama','email','username','role','status')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $user = User::create([
            ...$request->all(),
            'password' => Hash::make($request->password)
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->all();

        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json($user);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json(['message'=>'User deleted']);
    }
}
