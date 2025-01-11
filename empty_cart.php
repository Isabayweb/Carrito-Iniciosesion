<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$stmt = $conn->prepare("DELETE FROM carritos WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

header('Location: cart.php');
?>
