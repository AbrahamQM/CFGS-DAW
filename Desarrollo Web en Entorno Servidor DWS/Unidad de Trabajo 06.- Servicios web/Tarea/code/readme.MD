# Proyecto SOAP Inventario de Productos

Este proyecto implementa un **servicio web SOAP en PHP** para consultar el PVP y el stock de productos en distintas tiendas.  
Incluye servidor, cliente, generación automática del WSDL y pruebas de consumo.

---

## 📋 Requisitos técnicos

Antes de ejecutar el proyecto asegúrate de cumplir con los siguientes requisitos:

- **PHP 8.x** instalado en tu sistema.
- **Extensión SOAP habilitada** en PHP.  
  - Comprueba con:  
    ```bash
    php -m | grep soap
    ```  
  - Si no aparece, habilítala en tu `php.ini` añadiendo:  
    ```
    extension=soap
    ```
- **Composer** instalado para gestionar dependencias.
- Servidor web local Apache 

---

## ⚙️ Instalación

1. Clona o descarga el proyecto en tu entorno local carpeta ApacheXX/htdocs.
2. Instala las dependencias con Composer:
   ```bash
   composer install

## 📁 Estructura
/public

 ├── servicio.php        # Servidor SOAP que expone la clase Operaciones

 ├── cliente.php         # Cliente SOAP que consume el servicio

 ├── generarWsdl.php     # Script para generar el WSDL automáticamente
 
 └── servicio.wsdl       # Archivo WSDL (contrato del servicio generado automáticamente desde el fichero generarWsdl.php)


/src

 └── Operaciones.php     # Clase con la lógica de negocio

/composer.json           # Configuración de dependencias y autoload

## Ejecución del proyecto:
- http://localhost/code/public/cliente.php



