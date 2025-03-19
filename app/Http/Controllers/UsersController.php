<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::Paginate();
        return view('users.index', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->nombre,
            'lastname' => $request->apellido,
            'email' => $request->email,
            'phone' => $request->telefono,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index'); // Redirige a la lista de usuarios
    }
}
