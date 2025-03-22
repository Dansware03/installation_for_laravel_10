# Sistema de Asistente de Instalación - Laravel 10

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://semver.org)

![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?logo=php&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-885630?logo=composer&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?logo=mysql&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-3-003B57?logo=sqlite&logoColor=white)

Este proyecto implementa un asistente de instalación interactivo para una aplicación Laravel 10, permitiendo configurar fácilmente una nueva instancia con base de datos (MySQL o SQLite), usuario administrador, y configuraciones básicas del sistema.

## Características Principales

- **Asistente de Instalación Guiado**: Interfaz paso a paso para la configuración del sistema
- **Verificación de Requisitos**: Comprobación automática de requisitos del sistema
- **Configuración Flexible de Base de Datos**: Soporte para MySQL y SQLite
- **Creación de Usuario Root**: Configuración de administrador con privilegios completos
- **Migración Automática**: Ejecución de migraciones y seeders tras la configuración
- **Modo de Entorno**: Configuración adaptable para entornos de producción o desarrollo
- **API REST Segura**: Implementación de autenticación basada en tokens con Laravel Sanctum

## Requisitos del Sistema

- 🐘 PHP >= 8.1
- 📦 Composer
- 🗃️ MySQL 5.7+ o SQLite 3 (según preferencia)
- 🔌 Extensiones PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
- 📂 Permisos de escritura en directorios de storage y bootstrap/cache

## Instalación

1. Clone el repositorio:
   ```bash
   git clone https://github.com/Dansware03/installation_for_laravel_10.git
   cd installation_for_laravel_10
   ```

2. Instale las dependencias:
   ```bash
   composer install
   ```

3. Cree una copia del archivo de entorno:
   ```bash
   cp .env.example .env
   ```

4. Genere la clave de aplicación:
   ```bash
   php artisan key:generate
   ```

5. Acceda al asistente de instalación:
   ```bash
   php artisan serve
   ```
   Luego visite: http://localhost:8000/install

## Flujo de Instalación

El asistente de instalación guía al usuario a través de los siguientes pasos:

1. **Bienvenida**: Introducción al asistente de instalación
2. **Verificación de Requisitos**: Comprueba que el servidor cumpla con todos los requisitos
3. **Configuración de Base de Datos**: Elección entre MySQL o SQLite y configuración de conexión
4. **Creación de Usuario Root**: Establecimiento de credenciales para el administrador principal
5. **Instalación**: Ejecución de migraciones, seeders y configuraciones finales
6. **Finalización**: Confirmación de instalación exitosa y credenciales de acceso

## Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/
│   │   └── InstallationController.php   # Controlador principal de instalación
│   └── Middleware/
│       └── InstallationMiddleware.php   # Middleware para gestionar estado de instalación
├── ...
resources/
├── views/
│   └── installation/                    # Vistas del asistente de instalación
│       ├── layout.blade.php             # Layout principal del asistente
│       ├── welcome.blade.php            # Página de bienvenida
│       ├── requirements.blade.php       # Verificación de requisitos
│       ├── database.blade.php           # Configuración de base de datos
│       ├── user.blade.php               # Creación de usuario root
│       └── finish.blade.php             # Confirmación de instalación
routes/
├── web.php                              # Rutas web incluyendo rutas de instalación
├── api.php                              # Rutas de API protegidas por autenticación
database/
├── migrations/                          # Migraciones de la base de datos
└── seeders/                             # Seeders para datos iniciales
```

## API REST

El sistema incluye una API REST protegida por autenticación basada en tokens usando Laravel Sanctum. Tras la instalación, el usuario root recibe un token de API que puede utilizarse para realizar solicitudes autenticadas.

Ejemplo de autenticación:

```bash
curl -X POST \
  http://localhost:8000/api/login \
  -H 'Content-Type: application/json' \
  -d '{
    "email": "admin@example.com",
    "password": "password"
}'
```

## Personalización

### Requisitos del Sistema

Para modificar los requisitos verificados durante la instalación, edite el método `checkRequirements()` en `InstallationController.php`.

### Base de Datos

Para agregar soporte para otros motores de base de datos, modifique:
- La vista `database.blade.php` para incluir opciones adicionales
- El método `saveDatabase()` en `InstallationController.php`

### Configuración Adicional

Para agregar pasos adicionales al asistente de instalación, cree:
1. Nueva vista en `resources/views/installation/`
2. Nuevos métodos en `InstallationController.php`
3. Nuevas rutas en `routes/web.php`

## Seguridad

- El sistema implementa protección CSRF para todos los formularios
- La autenticación API utiliza tokens con tiempo de expiración
- Las contraseñas se almacenan con hash seguro mediante bcrypt
- El acceso al asistente de instalación se bloquea automáticamente tras completar la instalación

## Licencia

Este proyecto está licenciado bajo [MIT](https://choosealicense.com/licenses/mit/)

## Contribución

Las contribuciones son bienvenidas. Por favor, abra un issue para discutir cambios importantes antes de enviar un pull request.