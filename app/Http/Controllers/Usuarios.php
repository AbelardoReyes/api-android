<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Usuarios extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function registrarse(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = encrypt($request->password);
        $user->phone_number = $request->phone_number;
        if ($user->save()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Usuario registrado correctamente'
            ]);
        }
    }
    public function login(Request $request)
    {
        if (!$user = User::where('email', $request->email)->first()) {
            return response()->json([
                "status" => 401,
                "message" => "Usuario Inactivo",
                "error" => [],
                "data" => []
            ], 401);
        }
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => 401,
                "message" => "Contraseña invalido",
                "error" => [],
                "data" => $user
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => 201,
            'token' => $token,
            'role' => '3'
        ]);
    }
    public function info(Request $request)
    {
        $user = auth()->user();
        return response()->json([
            "name" => $user->name,
            "email" => $user->email,
            "phone_number" => $user->phone_number
        ]);
    }
}
