<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('role');
        
        // Filtrar por rol si se proporciona
        if ($request->has('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('name', $request->input('role'));
            });
        }
        
        $perPage = $request->input('per_page', 15);
        $users = $query->paginate($perPage);
        
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'role' => 'required|string|exists:roles,name',
        ]);
        
        // Obtener el rol
        $role = Role::where('name', $request->input('role'))->firstOrFail();
        
        // Crear el usuario
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'role_id' => $role->id,
        ]);
        
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user->load('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'sometimes|required|string|min:8',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'role' => 'sometimes|required|string|exists:roles,name',
        ]);
        
        // Actualizar campos básicos
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
        
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        
        if ($request->has('direccion')) {
            $user->direccion = $request->input('direccion');
        }
        
        if ($request->has('telefono')) {
            $user->telefono = $request->input('telefono');
        }
        
        // Actualizar rol si se proporciona
        if ($request->has('role')) {
            $role = Role::where('name', $request->input('role'))->firstOrFail();
            $user->role_id = $role->id;
        }
        
        $user->save();
        
        return response()->json($user->load('role'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Evitar eliminar el propio usuario autenticado
        if (auth()->id() === $user->id) {
            return response()->json(['message' => 'No puedes eliminar tu propio usuario'], 400);
        }
        
        // Evitar eliminar el último usuario root
        if ($user->isRoot() && User::whereHas('role', function ($q) {
            $q->where('name', 'root');
        })->count() <= 1) {
            return response()->json(['message' => 'No puedes eliminar el último usuario root'], 400);
        }
        
        $user->delete();
        
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
