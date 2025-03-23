# Sistema de Asistente de Instalación - Laravel 10

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://semver.org)

![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?logo=php&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-885630?logo=composer&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?logo=mysql&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-3-003B57?logo=sqlite&logoColor=white)

Este proyecto implementa un asistente de instalación interactivo para una aplicación Laravel 10, permitiendo configurar fácilmente una nueva instancia con base de datos (MySQL o SQLite), usuario administrador y configuraciones básicas del sistema.

---

## Características Principales

- **Asistente de Instalación Guiado:** Interfaz paso a paso para la configuración del sistema.
- **Verificación de Requisitos:** Comprobación automática de requisitos del sistema.
- **Configuración Flexible de Base de Datos:** Soporte para MySQL y SQLite, con posibilidad de probar la conexión en tiempo real.
- **Creación de Usuario Root:** Configuración del usuario administrador con privilegios completos.
- **Migración Automática:** Ejecución de migraciones y seeders tras la configuración.
- **Modo de Entorno:** Configuración adaptable para entornos de producción o desarrollo.
- **API REST Segura:** Implementación de autenticación basada en tokens usando Laravel Sanctum.

---

## Nuevas Mejoras y Funcionalidades

### Diseño Moderno y Sofisticado
- Interfaz completamente rediseñada con efectos de transición suaves.
- Tarjetas con bordes redondeados, sombras sutiles y tipografía mejorada.
- Espaciado coherente en todas las vistas.

### Modo Claro/Oscuro
- Cambio automático según la preferencia del sistema.
- Botón para alternar manualmente entre modos.
- Cambio dinámico del logo (logo_for_light.svg / logo_for_dark.svg) según el tema seleccionado.

### Logo y Branding
- Integración del logo en el encabezado junto al título.
- Cambio automático de logo según el tema activo.

### Iconos y Visualización Mejorada
- Integración de iconos SVG para cPanel, Linux y Windows.
- Diseño de tarjetas para mostrar instrucciones de forma clara y organizada.

### Detección Automática del Sistema Operativo
- Script JavaScript que detecta si el usuario utiliza Windows.
- Muestra solo las instrucciones relevantes según el sistema operativo.

### Información del Desarrollador
- Enlace directo a Instagram en el pie de página.
- La versión de Laravel se muestra automáticamente.

### Mejoras en el Flujo de Instalación
- Pasos de instalación con indicadores visuales mejorados.
- Estilo visual que destaca en qué paso se encuentra el usuario.

### Vista de Requisitos (requirements.blade.php)
- Título con gradiente y tabla de requisitos rediseñada.
- Uso de iconos relevantes para cada tipo de requisito.
- Estilo de tarjeta con sombras sutiles para una apariencia moderna.

### Mejoras en las Alertas y Botones
- Alertas con diseño moderno e iconos, alineadas con el tema general.
- Botones rediseñados para mayor consistencia y usabilidad.
- Botón "Siguiente" visualmente mejorado cuando está deshabilitado.

### Vista de Base de Datos (database.blade.php)
- Formulario reorganizado con diseño de tarjeta moderno.
- Campos con iconos en grupos de entrada para mejorar la experiencia.
- Diseño en dos columnas para algunos campos.
- Funcionalidades adicionales:
  - Botón para mostrar/ocultar contraseña.
  - Botón para probar la conexión real a la base de datos (AJAX).
  - Mensajes de retroalimentación visual para errores.

### Vista de Usuario (user.blade.php)
- Título con gradiente utilizando la clase `welcome-heading`.
- Organización en grid con filas y columnas para un mejor aprovechamiento del espacio.
- Uso de iconos Font Awesome para cada campo, aportando contexto visual.
- Sección de recomendaciones de seguridad con estilo de nota.
- Visualización de contraseña con botones toggle para mostrar/ocultar.
- Validación visual mejorada con iconos en los mensajes de error.
- Botones en el footer con iconos apropiados.

### Vista de Finalización (finish.blade.php)
- Notificación de token con diseño destacado y color verde.
- Sistema de copiado con feedback visual y tooltip.
- Campos de entrada con iconos y grupos de entrada.
- Sección de entorno con diseño mejorado e iconos explicativos.
- Panel de seguridad reorganizado en dos columnas con iconos de verificación.
- Textos de ayuda bajo los campos para mayor contexto.
- Botones de acción mejorados con iconos relacionados.

---

## Requisitos del Sistema

- 🐘 **PHP >= 8.1**
- 📦 **Composer**
- 🗃️ **MySQL 5.7+** o **SQLite 3** (según preferencia)
- 🔌 **Extensiones PHP:** BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML.
- 📂 **Permisos de escritura** en directorios `storage` y `bootstrap/cache`.

---

## Instalación

1. **Clone el repositorio:**
   ```bash
   git clone https://github.com/Dansware03/installation_for_laravel_10.git
   cd installation_for_laravel_10
   ```

2. **Instale las dependencias:**
   ```bash
   composer install
   ```

3. **Cree una copia del archivo de entorno:**
   ```bash
   cp .env.example .env
   ```

4. **Genere la clave de aplicación:**
   ```bash
   php artisan key:generate
   ```

5. **Acceda al asistente de instalación:**
   ```bash
   php artisan serve
   ```
   Luego visita: [http://localhost:8000/install](http://localhost:8000/install)

---

## Flujo de Instalación

El asistente de instalación guía al usuario a través de los siguientes pasos:

1. **Bienvenida:** Introducción al asistente de instalación.
2. **Verificación de Requisitos:** Comprueba que el servidor cumpla con todos los requisitos.
3. **Configuración de Base de Datos:** Elección entre MySQL o SQLite y configuración de conexión, con opción de probar la conexión real.
4. **Creación de Usuario Root:** Establecimiento de credenciales para el administrador principal.
5. **Instalación:** Ejecución de migraciones, seeders y configuraciones finales.
6. **Finalización:** Confirmación de instalación exitosa, visualización del token y detalles del entorno.

---

## Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/
│   │   └── InstallationController.php   # Controlador principal de instalación
│   └── Middleware/
│       └── InstallationMiddleware.php     # Middleware para gestionar estado de instalación
├── ...
resources/
├── views/
│   └── installation/                      # Vistas del asistente de instalación
│       ├── layout.blade.php               # Layout principal del asistente
│       ├── welcome.blade.php              # Página de bienvenida
│       ├── requirements.blade.php         # Verificación de requisitos (diseño modernizado)
│       ├── database.blade.php             # Configuración de base de datos (formulario mejorado)
│       ├── user.blade.php                 # Creación de usuario root (vista rediseñada)
│       └── finish.blade.php               # Confirmación de instalación con token y entorno
routes/
├── web.php                                # Rutas web incluyendo rutas de instalación y test de conexión
├── api.php                                # Rutas de API protegidas por autenticación
├── installation.php                       # Rutas de instalación
database/
├── migrations/                            # Migraciones de la base de datos
└── seeders/                               # Seeders para datos iniciales
```

---

## API REST

El sistema incluye una API REST protegida por autenticación basada en tokens usando Laravel Sanctum. Tras la instalación, el usuario root recibe un token de API que puede utilizarse para realizar solicitudes autenticadas.

**Ejemplo de autenticación:**

```bash
curl -X POST \
  http://localhost:8000/api/login \
  -H 'Content-Type: application/json' \
  -d '{
    "email": "admin@example.com",
    "password": "password"
}'
```

---

## Personalización

### Requisitos del Sistema

Para modificar los requisitos verificados durante la instalación, edite el método `checkRequirements()` en `InstallationController.php`.

### Base de Datos

Para agregar soporte para otros motores de base de datos, modifique:
- La vista `database.blade.php` para incluir opciones adicionales.
- El método `saveDatabase()` en `InstallationController.php`.

### Configuración Adicional

Para agregar pasos adicionales al asistente de instalación, cree:
1. Nuevas vistas en `resources/views/installation/`.
2. Nuevos métodos en `InstallationController.php`.
3. Nuevas rutas en `routes/web.php`.

---

## Seguridad

- El sistema implementa protección CSRF para todos los formularios.
- La autenticación API utiliza tokens con tiempo de expiración.
- Las contraseñas se almacenan con hash seguro mediante bcrypt.
- El acceso al asistente de instalación se bloquea automáticamente tras completar la instalación.

---

## Contribución

Las contribuciones son bienvenidas. Por favor, abre un issue para discutir cambios importantes antes de enviar un pull request.

---

## Licencia

Este proyecto está licenciado bajo [MIT](https://choosealicense.com/licenses/mit/)