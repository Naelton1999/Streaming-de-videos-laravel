<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    protected $user;

    public function __construct(Usuarios $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json(['message' => 'Usuário registrado com sucesso.']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = $this->user->where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        if ($token = JWTAuth::fromUser($user)) {
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Usuário desconectado com sucesso.']);
    }


}
