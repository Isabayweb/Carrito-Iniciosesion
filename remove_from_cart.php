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
    $stmt = $pdo->prepare("SELECT cantidad FROM carritos WHERE usuario_id = :usuario_id AND producto_id = :producto_id");
    $stmt->execute(['usuario_id' => $usuario_id, 'producto_id' => $producto_id]);
    $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        if ($cart_item['cantidad'] > 1) {
            // Si hay más de una unidad, reduce la cantidad
            $stmt = $pdo->prepare("UPDATE carritos SET cantidad = cantidad - 1 WHERE usuario_id = :usuario_id AND producto_id = :producto_id");
            $stmt->execute(['usuario_id' => $usuario_id, 'producto_id' => $producto_id]);
        } else {
            // Si solo hay una unidad, elimina el producto del carrito
            $stmt = $pdo->prepare("DELETE FROM carritos WHERE usuario_id = :usuario_id AND producto_id = :producto_id");
            $stmt->execute(['usuario_id' => $usuario_id, 'producto_id' => $producto_id]);
        }
    }
}

header('Location: cart.php');
?>
