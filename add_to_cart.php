<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    // Si el usuario no está autenticado, redirige al inicio de sesión
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verifica si el producto ya está en el carrito del usuario
    $stmt = $pdo->prepare("SELECT cantidad FROM carritos WHERE usuario_id = :usuario_id AND producto_id = :producto_id");
    $stmt->execute(['usuario_id' => $usuario_id, 'producto_id' => $producto_id]);
    $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        // Si ya existe, incrementa la cantidad
        $stmt = $pdo->prepare("UPDATE carritos SET cantidad = cantidad + 1 WHERE usuario_id = :usuario_id AND producto_id = :producto_id");
        $stmt->execute(['usuario_id' => $usuario_id, 'producto_id' => $producto_id]);
    } else {
        // Si no existe, agrega el producto al carrito
        $stmt = $pdo->prepare("INSERT INTO carritos (usuario_id, producto_id, cantidad) VALUES (:usuario_id, :producto_id, 1)");
        $stmt->execute(['usuario_id' => $usuario_id, 'producto_id' => $producto_id]);
    }
}

header('Location: productos.php');
?>
