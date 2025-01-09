<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lugox Music</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/logo lugox azul.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

<?php
session_start();
require 'db.php';

$error ="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta al usuario
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE nombre_usuario = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica la contraseña
    if ($user && password_verify($password, $user['contraseña'])) {
        // Almacena los datos del usuario en la sesión
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
        header('Location: index.php'); // Redirige al área de usuario
        exit();
    } else {
       $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>


       <? include 'header.php'?>
       
    <main>
        <form class="login" action="login.php" method="POST">
            <label for="username">Nombre de usuario:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <div class="CheckBox1">
                <input type="checkbox" onclick="verpassword()"> Mostrar contraseña
            </div>
            <?php if (!empty($error)): ?>
                <div class="error-message" style="color: red; font-size: 14px;">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <br>
            <button type="submit">Iniciar Sesión</button>
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a>.</p>
        </form>
    </main>   

    <script>
        function verpassword() {
            let tipo = document.getElementById("password");
            if (tipo.type === "password") {
                tipo.type = "text";
            } else {
                tipo.type = "password";
            }
        }
    </script>

 
</body>
</html>
