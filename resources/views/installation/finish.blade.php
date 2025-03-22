@extends('installation.layout')

@section('content')
    <h3>Finalizar Instalación</h3>
    <p>Últimos pasos para completar la instalación del sistema.</p>

    @if(isset($token))
    <div class="alert alert-info">
        <strong>¡Usuario Root creado con éxito!</strong>
        <p class="mb-0 mt-2">Se ha generado un token de API para el usuario Root. Guárdalo en un lugar seguro, ya que no podrás verlo nuevamente:</p>
        <div class="bg-dark text-white p-2 mt-2 rounded d-flex justify-content-between align-items-center">
            <code id="token-text" class="mr-2">{{ $token }}</code>
            <button 
                type="button" 
                class="btn btn-sm btn-outline-light copy-token" 
                title="Copiar al portapapeles"
                onclick="copyToClipboard('{{ $token }}')"
            >
                <i class="fas fa-copy"></i>
            </button>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Cambiar temporalmente el icono para feedback visual
                const btn = document.querySelector('.copy-token');
                const icon = btn.querySelector('i');
                icon.classList.remove('fa-copy');
                icon.classList.add('fa-check');
                
                // Restaurar el icono después de 2 segundos
                setTimeout(() => {
                    icon.classList.remove('fa-check');
                    icon.classList.add('fa-copy');
                }, 2000);
            }).catch(err => {
                console.error('Error al copiar:', err);
                alert('Error al copiar el token. Por favor cópialo manualmente.');
            });
        }
    </script>
@endif

    <form method="POST" action="{{ route('installation.finish.save') }}" id="finish_form">
        @csrf

        <div class="mb-3">
            <label for="app_url" class="form-label">URL de la Aplicación</label>
            <input type="url" class="form-control" id="app_url" name="app_url" value="{{ config('app.url') }}" required>
            @error('app_url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Entorno</label>
            <div class="d-flex gap-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="environment" id="env_local" value="local" checked>
                    <label class="form-check-label" for="env_local">
                        Desarrollo (local)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="environment" id="env_production" value="production">
                    <label class="form-check-label" for="env_production">
                        Producción
                    </label>
                </div>
            </div>
            @error('environment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="alert alert-warning">
            <strong>Nota:</strong> Si seleccionas "Producción", se habilitarán las siguientes configuraciones de seguridad:
            <ul class="mb-0">
                <li>APP_DEBUG se establecerá en false</li>
                <li>Se habilitarán cookies seguras para la sesión</li>
                <li>Se configurarán dominios estatales para Sanctum</li>
            </ul>
        </div>
    </form>
@endsection

@section('footer')
    <a href="{{ route('installation.user') }}" class="btn btn-secondary">Anterior</a>
    <button form="finish_form" type="submit" class="btn btn-primary">Finalizar Instalación</button>
@endsection
