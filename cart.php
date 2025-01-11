<!DOCTYPE html>
<html lang="en">
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

    <div class="contenedor-cart">

    <?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

echo "<h1>Tu Carrito</h1>";

$totalPrice = 0;

// Obtén los productos del carrito del usuario desde la base de datos
$stmt = $conn->prepare("
    SELECT p.id, p.name, p.price, p.image, c.cantidad
    FROM carritos c
    INNER JOIN products p ON c.producto_id = p.id
    WHERE c.usuario_id = ?
");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($item = $result->fetch_assoc()) {
        $total = $item['price'] * $item['cantidad'];
        $totalPrice += $total;

        echo "<div class='cart custom-class'>";
        echo "<img src='images/" . $item["image"] . "' alt='" . $item["name"] . "' style='width:100px;height:auto;'>";
        echo "<h2>" . $item["name"] . "</h2>";
        echo "<p> x " . $item["cantidad"] . " </p>";
        echo "<a href='remove_from_cart.php?id=" . $item["id"] . "'><i class='bx bxs-trash'></i></a>";
        echo "</div>";
    }
         echo "<div class='cart2 custom-class'>";
         echo "<p>Total: $" . $totalPrice . "</p>";
         echo "<a href='empty_cart.php'>Vaciar Carrito</a>";
         echo "<form action='send_order.php' method='post'>";
         echo "<input type='submit' value='Enviar Pedido'> ";
         echo "</form>";
         echo "</div>";
} else {
    echo "El carrito está vacío.";
}
?>

       
      
</div>
      </main>


      <footer>
        <div class="footer-info">
            <img src="img/logo lugox azul.jpg" alt="" style="width: 50px; height: 50px;">
            <div class="info-item">
                <i class='bx bx-map' style='color:#f3f3f3'></i>
                <span>Av Nazca 2451- CABA</span>
            </div>
            <div class="info-item">
                <i class='bx bx-phone' style='color:#fdfdfd'  ></i>
                <span>011-45011658</span>
            </div>
            <div class="info-item">
                <i class='bx bx-envelope' style='color:#ffffff'  ></i>
                <span>lugoxmusic@hotmail.com</span>
            </div>
            <div class="info-item">
                <i class='bx bx-door-open' style='color:#ffffff'  ></i>
                <span>Lunes a Viernes 10 a 14 hs y 15 a 19 hs.
                      Sábados 10 a 14 hs.      
                </span>
            </div>
        </div>
 

       
        <div class="redes">
            <span >ESCRIBINOS: </span>
            <a href="https://wa.me/1153409505" target="_blank"><i class='bx bxl-whatsapp' style='color:#000000; background-color: green; '></i></a>
            <span class="seguinos">SEGUINOS</span>    
            <a href="https://www.facebook.com/profile.php?id=100009159663027" target="_blank"><i class='bx bxl-facebook' style='color:#000000; background-color: rgb(62, 62, 239);'  ></i></a>
            <a href="https://www.instagram.com/lugoxmusic/" target="_blank"><i class='bx bxl-instagram' style='color:#000000; background-color: rgb(181, 29, 181); '></i></a>
            <a href="" target="_blank"><i class='bx bxl-youtube' style='color:#000000; background-color: red; '></i></a>
        </div>
    </footer>

        <script src="js/script.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>
