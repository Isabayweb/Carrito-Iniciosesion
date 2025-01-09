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

        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel"  >
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="1000">
                <img src="img/logo-carrousel.png" class="d-block w-100" alt="...">
                
              </div>
              <div class="carousel-item"  data-bs-interval="2500">
                <img src="img/slide 2.png" class="d-block w-100" alt="...">
                <div class="ia-lugox">
                  <h6 class="texto-carrousel">Dice la IA de nosotros: <br> "Descubre el mundo de la música en Lugox Music"</h6>
                  <img src="img/IA-lugox.jpeg" alt="Imagen de IA Lugox">
              </div>
              </div>
              <div class="carousel-item" data-bs-interval="2500">
                <img src="img/Accesorios de Instrumentos Musicales.png" class="d-block w-100"  " alt="...">
                
              </div>
              <div class="carousel-item" data-bs-interval="2500">
                <img src="img/LutheriaDefenitiva.png" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <div class="main">

        <!--
        <section class="search-container">
           
                <form action="/search" method="GET">
                    <input type="text" placeholder="Buscar..." name="search">
                    <button type="submit">Buscar</button>
                </form>
           
        </section>
        -->
        <section style="position: relative;">
              <button class="prev" onclick="moveLeft()">&#10094;</button>
            <div class="cards-container">
              <a href="confian.php"><div class="cards" style="background-image: url(img/Confian.jpeg); background-size: 100%; background-repeat: no-repeat;"><h6>Confían en nosotros</h6></div></a>
              <a href="productos.php"><div class="cards" style="background-image: url(img/productos.png); background-size: 100%; background-repeat: no-repeat;" ><h6>Productos</h6></div></a>
              <a href="lutheria.php"><div class="cards" style="background-image: url(img/Lutheria.jpeg); background-size: 100%; background-repeat: no-repeat;" ><h6>Luthería</h6></div></a>
            
              
               

            </div>
            <button class="next" onclick="moveRight()">&#10095;</button>
        </section>


        </div>

 
      </main>


    <?include 'footer.php'?>

        <script src="js/script.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>