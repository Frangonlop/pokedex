<?php
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['confirm_pass'];

    // Validar que ambas contraseñas coincidan
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden. Vuelve a intentarlo";
        exit();
    }

    $login = filter_var($login, FILTER_SANITIZE_STRING);
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli($HOST, $NAME, $PASSWORD, $BD, $PORT);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO usuarios (login, pass) VALUES (?, ?)");
    $stmt->bind_param("ss", $login, $password_hashed);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['login'] = $login;
        header("Location: ../../index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
