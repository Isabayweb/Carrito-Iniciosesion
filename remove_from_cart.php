<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Obtén la cantidad actual del producto en el carrito
    $stmt = $conn->prepare("SELECT cantidad FROM carritos WHERE usuario_id = ? AND producto_id = ?");
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($cantidad);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        if ($cantidad > 1) {
            // Si hay más de una unidad, reduce la cantidad
            $stmt = $conn->prepare("UPDATE carritos SET cantidad = cantidad - 1 WHERE usuario_id = ? AND producto_id = ?");
            $stmt->bind_param("ii", $usuario_id, $producto_id);
            $stmt->execute();
        } else {
            // Si solo hay una unidad, elimina el producto del carrito
            $stmt = $conn->prepare("DELETE FROM carritos WHERE usuario_id = ? AND producto_id = ?");
            $stmt->bind_param("ii", $usuario_id, $producto_id);
            $stmt->execute();
        }
    }
}

header('Location: cart.php');
?>

