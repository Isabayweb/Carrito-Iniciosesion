<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$stmt = $pdo->prepare("DELETE FROM carritos WHERE usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $usuario_id]);

header('Location: cart.php');
?>
