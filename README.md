# RecruitAPI - Backend

## Descripción
Este proyecto constituye el motor de servidor para el Sistema de Reclutamiento. Se trata de una API RESTful desarrollada en PHP que gestiona la persistencia de datos y la lógica de negocio para la administración de candidatos, cargos y procesos de selección.

## Datos de Entrega
- **Estudiante:** Camilo Lavado  
- **Carrera:** Ingeniería en Informática  
- **Institución:** Instituto Profesional San Sebastián  
- **Asignatura:** Desarrollo Backend  
- **Evaluación:** Evaluación Sumativa N° 1  
- **Docente:** Vicente Alfonso Zapata Concha  

## Estructura del Proyecto
```
prueba1/
├── Config/
│   └── Db.php              # Clase de conexión mediante PDO
├── Controllers/
│   ├── CandidatosController.php
│   ├── CargosController.php
│   ├── EntrevistadoresController.php
│   ├── EntrevistasController.php
│   ├── ExperienciasController.php
│   └── UsuariosController.php
├── Models/
│   ├── Candidatos.php      # Lógica de datos de postulantes
│   ├── Cargos.php          # Gestión de vacantes
│   ├── Entrevistadores.php # Datos del equipo técnico
│   ├── Entrevistas.php     # Agenda y estados de procesos
│   ├── Experiencias.php    # Historial laboral
│   └── Usuarios.php        # Gestión de acceso y seguridad
├── SQL Files/
│   ├── Tablas.sql          # Script de creación de esquema
│   └── Datos.sql           # Datos de prueba para poblar
├── index.php               # Enrutador centralizado (Front Controller)
└── postman_collection.json # Colección de pruebas para endpoints
```

## Arquitectura y Tecnologías
El sistema implementa el patrón **Modelo-Vista-Controlador (MVC)**. El archivo `index.php` actúa como punto de entrada único que deriva las solicitudes a los controladores específicos.

- **Lenguaje:** PHP 7.4+  
- **Persistencia:** MySQL / MariaDB con driver PDO  
- **Seguridad:** Consultas preparadas para evitar inyección SQL  
- **Intercambio de datos:** JSON  

## Referencia de la API
La URL base es:

```
http://localhost/prueba1/index.php
```

Todas las entidades cuentan con operaciones CRUD completas (Listar, Obtener, Crear, Actualizar, Eliminar).

### Endpoints Principales
- **Usuarios:** login, listar, crear, actualizar, eliminar lógico y eliminar Fisico  
- **Candidatos:** listar, obtener, crear, actualizar, eliminar  
- **Cargos:** listar, obtener, crear, actualizar, eliminar  
- **Entrevistas:** listar, obtener, crear, actualizar, eliminar  
- **Experiencias:** listar, obtener, crear, actualizar, eliminar  

## Códigos de Respuesta
- **200 OK:** Operación realizada con éxito  
- **201 Created:** Recurso creado correctamente  
- **400 Bad Request:** Error de validación o datos faltantes  
- **401 Unauthorized:** Credenciales de acceso incorrectas  
- **404 Not Found:** El recurso solicitado no existe  
- **500 Internal Error:** Error inesperado en el servidor o base de datos  

## Seguridad e Integridad
- **Validación Preventiva:** Los controladores verifican la presencia de campos obligatorios antes de interactuar con la base de datos.  
- **Consultas Preparadas:** Uso de `PDO::prepare` y `bindParam` para mitigar ataques de inyección de código.  
- **Gestión de Contraseñas:** Uso de `password_hash` y `password_verify` para el manejo seguro de credenciales.  
- **Integridad Referencial:** Los modelos capturan excepciones de llaves foráneas para evitar inconsistencias en la base de datos.  

## Instalación y Configuración
1. Clonar el repositorio en la carpeta de servidor local (htdocs o similar).  
2. Crear la base de datos **eva1** en MySQL.  
3. Ejecutar los scripts ubicados en la carpeta **SQL Files**.  
4. Ajustar los parámetros de conexión en `Config/Db.php` si es necesario.  

Para el correcto funcionamiento del frontend, asegúrese de configurar la constante `API_BASE` en el archivo `js/config.js` con la ruta de este servidor.

## Credenciales de Acceso
- **Usuario:** admin_sistema  
- **Password:** password  

## Escalabilidad
Se proponen las siguientes mejoras para el desarrollo futuro:

- Implementación de autenticación basada en JWT (JSON Web Tokens).  
- Creación de índices en columnas de búsqueda frecuente (email, nombre_usuario).  
- Paginación de resultados en listados extensos.  
