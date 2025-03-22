@extends('installation.layout')

@section('content')
    <div class="text-center mb-4">
        <h3>Bienvenido al Asistente de Instalación</h3>
        <p>Este asistente te guiará a través del proceso de configuración de tu aplicación Laravel 10 API REST.</p>
    </div>
    
    <div class="alert alert-info">
        <strong>Nota:</strong> Antes de continuar, asegúrate de:
        <ul class="mb-0">
            <li>Tener el archivo <code>.env</code> con permisos de escritura</li>
            <li>Tener los directorios <code>storage</code> y <code>bootstrap/cache</code> con permisos de escritura</li>
            <li>Tener configurado correctamente el servidor web (Apache/Nginx)</li>
        </ul>
    </div>
@endsection

@section('footer')
    <div></div>
    <a href="{{ route('installation.requirements') }}" class="btn btn-primary">Siguiente: Verificar Requisitos</a>
@endsection