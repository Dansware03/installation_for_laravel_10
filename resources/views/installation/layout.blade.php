<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalación - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
        }

        .install-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .install-header {
            background: #4a6cf7;
            color: white;
            padding: 20px;
        }

        .install-steps {
            display: flex;
            border-bottom: 1px solid #eee;
        }

        .install-step {
            flex: 1;
            text-align: center;
            padding: 15px 10px;
            position: relative;
        }

        .install-step.active {
            font-weight: bold;
            color: #4a6cf7;
        }

        .install-step.completed {
            color: #10b981;
        }

        .install-step:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 60%;
            width: 1px;
            background: #eee;
        }

        .install-content {
            padding: 30px;
        }

        .install-footer {
            display: flex;
            justify-content: space-between;
            padding: 20px 30px;
            border-top: 1px solid #eee;
        }

        .copy-token {
            transition: all 0.3s ease;
        }

        .copy-token:hover {
            transform: scale(1.1);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="install-container">
        <div class="install-header">
            <h2>Asistente de Instalación</h2>
            <p class="mb-0">{{ config('app.name', 'Laravel') }} - API REST Segura</p>
        </div>

        <div class="install-steps">
            <div
                class="install-step {{ request()->routeIs('installation.welcome') ? 'active' : (request()->routeIs('installation.requirements', 'installation.database', 'installation.user', 'installation.finish') ? 'completed' : '') }}">
                Bienvenida
            </div>
            <div
                class="install-step {{ request()->routeIs('installation.requirements') ? 'active' : (request()->routeIs('installation.database', 'installation.user', 'installation.finish') ? 'completed' : '') }}">
                Requisitos
            </div>
            <div
                class="install-step {{ request()->routeIs('installation.database') ? 'active' : (request()->routeIs('installation.user', 'installation.finish') ? 'completed' : '') }}">
                Base de Datos
            </div>
            <div
                class="install-step {{ request()->routeIs('installation.user') ? 'active' : (request()->routeIs('installation.finish') ? 'completed' : '') }}">
                Usuario Root
            </div>
            <div class="install-step {{ request()->routeIs('installation.finish') ? 'active' : '' }}">
                Finalizar
            </div>
        </div>

        <div class="install-content">
            @yield('content')
        </div>

        <div class="install-footer">
            @yield('footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>