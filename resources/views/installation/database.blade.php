@extends('installation.layout')

@section('content')
    <h3>Configuración de Base de Datos</h3>
    <p>Configura los parámetros de conexión a la base de datos.</p>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form id="database_form" method="POST" action="{{ route('installation.database.save') }}">
        @csrf

        <div class="mb-4">
            <label class="form-label">Tipo de Base de Datos</label>
            <div class="d-flex gap-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="database_type" id="type_mysql" value="mysql" checked>
                    <label class="form-check-label" for="type_mysql">
                        MySQL
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="database_type" id="type_sqlite" value="sqlite">
                    <label class="form-check-label" for="type_sqlite">
                        SQLite
                    </label>
                </div>
            </div>
        </div>

        <div id="mysql_fields">
            <div class="mb-3">
                <label for="database_host" class="form-label">Host</label>
                <input type="text" class="form-control" id="database_host" name="database_host" value="127.0.0.1">
                @error('database_host')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="database_port" class="form-label">Puerto</label>
                <input type="text" class="form-control" id="database_port" name="database_port" value="3306">
                @error('database_port')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="database_name" class="form-label">Nombre de la Base de Datos</label>
                <input type="text" class="form-control" id="database_name" name="database_name" value="laravel">
                @error('database_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="database_user" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="database_user" name="database_user" value="root">
                @error('database_user')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="database_password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="database_password" name="database_password">
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mysqlRadio = document.getElementById('type_mysql');
            const sqliteRadio = document.getElementById('type_sqlite');
            const mysqlFields = document.getElementById('mysql_fields');

            function toggleFields() {
                if (mysqlRadio.checked) {
                    mysqlFields.style.display = 'block';
                } else {
                    mysqlFields.style.display = 'none';
                }
            }

            mysqlRadio.addEventListener('change', toggleFields);
            sqliteRadio.addEventListener('change', toggleFields);

            toggleFields();
        });
    </script>
@endsection

@section('footer')
    <a href="{{ route('installation.requirements') }}" class="btn btn-secondary">Anterior</a>
    <button form="database_form" type="submit" class="btn btn-primary">Siguiente: Configurar Usuario Root</button>
@endsection
