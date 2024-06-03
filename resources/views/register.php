<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="form">
        <h1>Registrarse</h1>
        <form id="registerForm" action="../model/register_user.php" method="post">
            <label>Nombre de Usuario</label>
            <input type="text" name="login" required>
            <label>Password</label>
            <input type="password" name="pass" required>
            <label>Confirmar Password</label>
            <input type="password" name="confirm_pass" required>
            <input type="submit" value="Registrar" class="btn">
        </form>
        <p id="error-message" style="color: red;"></p>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            const password = document.querySelector('input[name="pass"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_pass"]').value;

            if (password !== confirmPassword) {
                event.preventDefault();
                document.getElementById('error-message').innerText = "Las contraseñas no coinciden. Vuelve a intentarlo";
            }
        });
    </script>
</body>
</html>
