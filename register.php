<?php
include 'db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verifica si el usuario o correo ya existen
    $stmt = $conn->prepare('SELECT COUNT(*) AS count FROM usuarios WHERE nombre_usuario = ? OR email = ?');
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        $error = "El nombre de usuario o correo ya está en uso.";
    } else {
        // Inserta el nuevo usuario en la base de datos
        $passwordHash = password_hash($password, PASSWORD_BCRYPT); // Encripta la contraseña
        $stmt = $conn->prepare('INSERT INTO usuarios (nombre_usuario, email, contraseña) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $username, $email, $passwordHash);
        $stmt->execute();

        // Recuperar el ID del nuevo usuario
        $userId = $stmt->insert_id;

        // Iniciar sesión automáticamente
        session_start();
        $_SESSION['usuario_id'] = $userId;
        $_SESSION['nombre_usuario'] = $username;

        // Redirigir a una página de bienvenida o el panel de usuario
        header('Location: index.php');
        exit();
    }

    $stmt->close();
}
?>




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

        <? include 'header.php'?>

    <main>

    <form class="register" action="register.php" method="POST">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
         <input type="checkbox" onclick="verpassword()"> Mostrar contraseña
         
        <br>
        <?php if (!empty($error)): ?>
                <div class="error-message" style="color: red; font-size: 14px;">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

        <button type="submit">Registrar</button>
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
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
