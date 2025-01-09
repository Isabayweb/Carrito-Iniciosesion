<header>
    <nav>
        <a href="index.php"><img src="img/logo lugox azul.jpg" alt="Logo"></a>

        <!-- Verifica si estamos en login.php o register.php y no muestra el carrito -->
        <?php
        $currentPage = basename($_SERVER['PHP_SELF']); // Obtiene el nombre del archivo PHP actual
        if ($currentPage !== 'login.php' && $currentPage !== 'register.php') {
            echo '<a href="cart.php"><i class="bx bxs-cart"></i></a>';
        }
        ?>

        <ul>
            <!-- Verificar si el usuario está logueado -->
            <?php
            session_start(); // Inicia la sesión
            if (isset($_SESSION['usuario_id']) && $currentPage !== 'login.php' && $currentPage !== 'register.php') {  // Si la sesión está iniciada y no estamos en login.php
                echo '<li><a href="logout.php">Cerrar sesión</a></li>';  // Mostrar "Cerrar sesión"
            } else if ($currentPage !== 'login.php' && $currentPage !== 'register.php') {
                echo '<li><a href="login.php">Iniciar sesión</a></li>';  // Mostrar "Iniciar sesión" si no estamos en login.php
            }
            ?>
        </ul>
    </nav>
</header>