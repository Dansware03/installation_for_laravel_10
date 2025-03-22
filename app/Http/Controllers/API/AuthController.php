<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Autenticar usuario y generar token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'nullable|string',
        ]);
        
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }
        
        $user = Auth::user();
        $deviceName = $request->device_name ?? ($request->userAgent() ?? 'Unknown Device');
        
        // Determinar las habilidades basadas en el rol
        $abilities = ['*'];  // Por defecto, todas las habilidades
        
        // Crear token con expiración (1 día para usuarios normales, 1 año para root)
        $expiresAt = $user->isRoot() ? now()->addYear() : now()->addDay();
        $token = $user->createToken($deviceName, $abilities, $expiresAt);
        
        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
            'expires_at' => $expiresAt,
        ]);
    }
    
    /**
     * Cerrar sesión (revocar token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
