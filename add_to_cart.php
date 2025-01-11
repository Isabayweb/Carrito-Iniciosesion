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
    $stmt = $conn->prepare("SELECT cantidad FROM carritos WHERE usuario_id = ? AND producto_id = ?");
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($cantidad);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Si ya existe, incrementa la cantidad
        $stmt = $conn->prepare("UPDATE carritos SET cantidad = cantidad + 1 WHERE usuario_id = ? AND producto_id = ?");
        $stmt->bind_param("ii", $usuario_id, $producto_id);
        $stmt->execute();
    } else {
        // Si no existe, agrega el producto al carrito
        $stmt = $conn->prepare("INSERT INTO carritos (usuario_id, producto_id, cantidad) VALUES (?, ?, 1)");
        $stmt->bind_param("ii", $usuario_id, $producto_id);
        $stmt->execute();
    }
}

header('Location: productos.php');
?>

