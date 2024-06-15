# Pokeverse

## Descripción del Proyecto

Pokeverse es una aplicación web que permite a los usuarios consultar información detallada sobre los Pokémon y gestionar equipos Pokémon. Los usuarios pueden registrarse en la plataforma para acceder a funcionalidades adicionales, como la creación y visualización de equipos competitivos.

## Requisitos de Instalación

Para instalar y ejecutar Pokeverse en tu entorno local, necesitas tener lo siguiente:

- **Apache2**: Servidor web para alojar la aplicación.
- **MySQL**: Base de datos para almacenar la información de usuarios y equipos.
- **PHP**: Lenguaje de programación para el backend de la aplicación.

## Instrucciones de Instalación

### Paso 1: Configuración del Entorno de Desarrollo

1. **Instalar Apache2**
   - En Ubuntu: 
     ```bash
     sudo apt update
     sudo apt install apache2
     ```
   - En Windows: Puedes usar WampServer o XAMPP.

2. **Instalar MySQL**
   - En Ubuntu:
     ```bash
     sudo apt install mysql-server
     ```
   - En Windows: MySQL viene incluido en WampServer o XAMPP.

3. **Instalar PHP**
   - En Ubuntu:
     ```bash
     sudo apt install php libapache2-mod-php php-mysql
     ```
   - En Windows: PHP viene incluido en WampServer o XAMPP.

### Paso 2: Configuración de la Base de Datos

1. Crear una base de datos MySQL para Pokeverse:
   ```sql
   CREATE DATABASE pokeverse;
    ```
### Paso 3: Crear un usuario y asignarle permisos:

```sql
CREATE USER 'pokeverse_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON pokeverse.* TO 'pokeverse_user'@'localhost';
FLUSH PRIVILEGES;
```

### Paso 4: Configuración del proyecto:

1. Clonar el repositorio de Pokeverse en el directorio raíz de Apache:
   ```bash
   git clone https://github.com/Frangonlop/pokedex.git /var/www/html/pokeverse
   ```
2. Configurar el Virtual Host para Apache:
  ```bash
  sudo nano /etc/apache2/sites-available/pokeverse.conf
  ```
Y añadir lo siguiente:
```apache
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/pokeverse
    ServerName pokeverse.local
    <Directory /var/www/html/pokeverse>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

3. Habilitar el sitio y reiniciar Apache:
```bash
sudo a2ensite pokeverse.conf
sudo systemctl restart apache2
```

4. Añadir la entrada en el archivo de hosts para resolver el nombre de dominio local:
```bash
sudo nano /etc/hosts
```
Y añadir lo siguiente.
```bash
127.0.0.1 pokeverse.local
```

### Paso 5: Acceder al script de instalación

Una vez hayamos hecho todos los pasos anteriores, al acceder a pokeverse.local, se nos redireccionará directamente al script de instalación donde se nos pedirá los datos de la base de datos que hemos creado asi como el usuario y su contraseña.

### Uso de la aplicación

Ya completado los datos se nos instala las tablas necesarias para el funcionamiento de la aplicación y se nos vuelve a redireccionar, pero esta vez al index donde ya veremos nuestra aplicación y podremos empezar a interactuar con ella
Para poder usar todas sus funcionalidades, tal como crear y guardar equipos se nos pedira que nos registremos e iniciemos sesión.
