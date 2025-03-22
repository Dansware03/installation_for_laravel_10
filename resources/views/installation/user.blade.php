@extends('installation.layout')

@section('content')
    <h3>Configuración de Usuario Root</h3>
    <p>Crea el primer usuario super administrador (Root) del sistema.</p>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('installation.user.save') }}" id="user_form">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección (opcional)</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono (opcional)</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
        </div>
    </form>
@endsection

@section('footer')
    <a href="{{ route('installation.database') }}" class="btn btn-secondary">Anterior</a>
    <button form="user_form" type="submit" class="btn btn-primary">Siguiente: Finalizar Instalación</button>
@endsection
