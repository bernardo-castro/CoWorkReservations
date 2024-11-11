# **CoWorkReservations**

Aplicación en Laravel para gestionar la reserva de espacios en un cowork. 

## **Requisitos Previos**

Para ejecutar esta aplicación, necesitas tener instalados los siguientes requisitos:

- **PHP 8.1 o superior**
- **MySQL** (o cualquier otra base de datos compatible configurada)
- **Composer** (gestor de dependencias de PHP)

## **Instalación**

Sigue estos pasos para instalar y configurar la aplicación:

### 1. **Clonar el repositorio**

Clona el repositorio en tu máquina local utilizando Git:

```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
```

### 2. **Instalar dependencias**

Instala las dependencias de PHP utilizando Composer:

```bash
composer install
```
Esto descargará todas las dependencias necesarias para ejecutar la aplicación.

### 3. **Configuración del archivo .env**

Copia tus variables en el archivo .env para configurar las variables de entorno:

```bash
APP_NAME=CoworkReservations
APP_ENV=local
APP_KEY=
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cowork_reservations
DB_USERNAME=root
DB_PASSWORD=

```
Asegúrate de configurar correctamente los parámetros de la base de datos (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).

### 4. **Generar la clave de la aplicación**

Genera la clave de la aplicación con el siguiente comando:

```bash
php artisan key:generate
```
Este comando generará una clave única y la asignará a la variable APP_KEY en el archivo .env.

### 5. **Migrar la base de datos y ejecutar seeders**

Ejecuta las migraciones de la base de datos y llena con datos iniciales (si tienes seeders configurados):

```bash
php artisan migrate --seed
```
Este comando migrará las tablas a la base de datos y ejecutará los seeders para insertar datos de prueba o iniciales.

```bash
Usuarios de Prueba
Admin        admin@example.com        admin123
Client1      client1@example.com      12345678
Client2      client2@example.com      12345678
```

### 6. **Iniciar el servidor de desarrollo**

Ahora puedes iniciar el servidor local de desarrollo con el siguiente comando:

```bash
php artisan serve
```
La aplicación estará disponible en http://localhost:8000.





