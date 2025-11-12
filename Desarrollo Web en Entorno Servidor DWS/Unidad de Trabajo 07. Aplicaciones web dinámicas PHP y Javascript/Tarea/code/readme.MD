# Proyecto Valoración de Productos

Esta aplicación permite a los usuarios registrados valorar productos en tiempo real mediante una interfaz web sencilla.  
Incluye sistema de login, listado de productos con valoración media redondeada, y votación mediante `fetch()` sin recargar la página.

---

## 📋 Requisitos técnicos

Antes de ejecutar el proyecto asegúrate de cumplir con los siguientes requisitos:

- **PHP 8.x** instalado en tu sistema.
- Servidor web local (Apache recomendado).
- **Extensión PDO para MySQL** habilitada en PHP.  
  - Compruébalo con: 
  
  -Linux
    ```bash
    php -m | grep pdo_mysql
    ```
  

  -Windows
    ```bash
    php -m | findstr pdo_mysql
    ```


---

## ⚙️ Instalación

1. Clona o descarga el proyecto en tu entorno local dentro de la carpeta `htdocs` o equivalente.
2. Importa el fichero `bbdd.sql` desde **phpMyAdmin** para crear la base de datos y cargar los datos iniciales.
   - Este paso es imprescindible para que la aplicación funcione correctamente.

---

## 👤 Usuarios de prueba

Puedes acceder a la aplicación con cualquiera de los siguientes usuarios:

| Usuario  | Contraseña  |
|----------|-------------|
| admin    | admin123    |
| ana      | ana123      |
| carlos   | carlos123   |
| juan     | juan123     |
| maria    | maria123    |

---

## 📁 Estructura

/bbdd  
 ├── bbdd.sql              # Script SQL con estructura y datos iniciales  
 └── conexion_bbdd.php     # Conexión a la base de datos mediante PDO  

/css  
 └── estilo.css            # Hoja de estilos (adaptada desde la práctica UT3)  

/public  
 ├── login.php             # Página de acceso con validación por `fetch()`  
 └── listado.php           # Listado de productos con votación en tiempo real  

/src  
 ├── proceso_login.php     # Procesa el login y crea la sesión  
 ├── proceso_logout.php    # Cierra la sesión del usuario  
 └── proceso_voto.php      # Inserta el voto y devuelve media y número de votos en JSON  

---

## ▶️ Ejecución del proyecto

Accede a la aplicación desde:

http://localhost/code/public/login.php