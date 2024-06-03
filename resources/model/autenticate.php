<?php
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['pass'];
    $redirect_url = isset($_POST['redirect_url']) ? $_POST['redirect_url'] : '../../index.php';

    // Verificar si la URL de redirección es relativa a la carpeta views
    if (strpos($redirect_url, 'views/') === false && strpos($redirect_url, 'index.php') === false) {
        $redirect_url = "../views/" . $redirect_url;
    } elseif (strpos($redirect_url, 'index.php') !== false) {
        $redirect_url = "../../index.php";
    }

    $conn = new mysqli($HOST, $NAME, $PASSWORD, $BD, $PORT);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['login'] = $login;
        header("Location: " . $redirect_url);
        exit();
    } else {
        echo "Login o contraseña incorrectos";
    }

    $stmt->close();
    $conn->close();
}
