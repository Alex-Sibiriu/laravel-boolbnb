<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request): Response{
        $request->validate([
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'birth_date' => 'required|string',
            'email' => 'required|string|max:255|lowercase|email|unique:users',
            'password' => 'required|confirmed',

        ]);

        $data = $request->only('email', 'name', 'surname', 'birth_date');
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        return response($user, 201);
    }

    public function login(Request $request): Response {
        $request->validate([
            'email' => 'required|string|max:255|lowercase|email',
            'password' => 'required',
        ]);

        $credentials = $request->all();

        if(Auth::attempt($credentials)){
            return response(Auth::user(), 200);
        }
        abort('401', 'login-failed');
    }
    public function logout(): Response {
        Auth::logout();
        return response(null, 204);
    }
}
