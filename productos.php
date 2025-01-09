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
    


 <?include 'header.php'?> 

<main>
<div class='contenedor-productos '>
<?php 

include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        echo "<div class='product custom-class'>";
        echo "<div class='imagen custom-class'> <img src='images/" . $row["image"] . "' alt='" . $row["name"] . "' style='width:100px;height:auto;'> </div>" ;       
        echo "<h2>" . $row["name"] . "</h2>";
        echo "<p>" . $row["description"] . "</p>";
        echo "<p>Precio: $" . $row["price"] . "</p>";
        echo "<a href='add_to_cart.php?id=" . $row["id"] . "'>Añadir al carrito</a>";
        echo "</div>";
        
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
</div>
</main>

</body>
</html>

