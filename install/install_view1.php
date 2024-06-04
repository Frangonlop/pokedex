<?php
    $archivo = "../config/config.php";
    if(file_exists($archivo)){
        header("Location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalar aplicacion</title>
    <link rel="stylesheet" href="../resources/css/main.css">
</head>
<body>
    <div class="form" id="instalation">
        <h1>Bienvenido al gestor de instalación</h1>
        <p>No se ha detectado una configuracion, para empezar debes tener preparado una base de datos y un usuario y contraseña que tenga acceso a dicha base de datos</p>
        <h2>Introduce las credenciales del sistema gestor de bases de datos:</h2>
        <form action="install1.php" method="post" class="install_form">
            <label>Host</label>
            <input type="text" name="host">
            <label>Nombre</label>
            <input type="text" name="nombre">
            <label>Password</label>
            <input type="password" name="pass">
            <label>Base de datos</label>
            <input type="text" name="bd">
            <label>Puerto</label>
            <input type="text" name="puerto">
            <input type="submit" value="confirmar" name="confirmar" class="btn">
        </form>
    </div>
</body>
</html>