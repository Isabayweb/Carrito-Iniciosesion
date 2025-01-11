<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Verifica si el carrito del usuario está vacío
$stmt = $conn->prepare("
    SELECT p.name, p.price, c.cantidad
    FROM carritos c
    INNER JOIN products p ON c.producto_id = p.id
    WHERE c.usuario_id = ?
");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "El carrito está vacío. No se puede enviar el pedido.";
    exit();
}

// Generar los detalles del pedido
$orderDetails = "";
$totalPrice = 0;

while ($item = $result->fetch_assoc()) {
    $total = $item['price'] * $item['cantidad'];
    $orderDetails .= "Producto: " . $item['name'] . "\n";
    $orderDetails .= "Cantidad: " . $item['cantidad'] . "\n";
    $orderDetails .= "Precio: $" . $item['price'] . " x " . $item['cantidad'] . " = $" . $total . "\n\n";
    $totalPrice += $total;
}

$orderDetails .= "Precio Total del Pedido: $" . $totalPrice;

// Formatear el mensaje para WhatsApp
$message = urlencode("Hola, quiero realizar el siguiente pedido:\n\n" . $orderDetails);

// Vaciar el carrito después de generar los detalles del pedido
$stmt = $conn->prepare("DELETE FROM carritos WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

// Número de WhatsApp al que se enviará el mensaje (cambiar por el número deseado)
$phoneNumber = "541167556113"; // Cambia esto por el número deseado en formato internacional

// Generar el enlace de WhatsApp
$whatsappUrl = "https://api.whatsapp.com/send?phone=$phoneNumber&text=$message";

// Redirigir al enlace de WhatsApp
header("Location: $whatsappUrl");
exit();
?>
