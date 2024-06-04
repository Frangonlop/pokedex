<?php
$archivo = "../../config/config.php";
if (!file_exists($archivo)) {
    header("Location: ../../install/install_view1.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <?php
    $redirect_url = isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect']) : '../../index.php';
    ?>
    <div class="form">
        <h1>Iniciar Sesión</h1>
        <form action="../model/autenticate.php" method="post">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" required>

            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass" required>

            <input type="hidden" name="redirect_url" value="<?php echo $redirect_url; ?>">

            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>

</html>