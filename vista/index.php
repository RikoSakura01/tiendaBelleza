<!doctype html>
<html lang="en">
  <head>
    <title>Index</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Bootstrap CSS v5.2.1 -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>

    <link href="../assets/index.css" rel="stylesheet" >
  </head>

  <body>
    <header>
    <?php include('../modelo/conexion.php'); ?>
    <?php include('navbar.php'); 
/////////////
if (isset($_SESSION['user_id'])){
    $id_usuario=$_SESSION['id_usuario']; //recupera de la sesion anterior
    $nombre=$_SESSION['nombre_usuario'];  
    $query = "SELECT id FROM carrito where id_usuario = :id_usuario";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_usuario',$id_usuario);
    $stmt->execute();
    $carrito = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['carrito_id'] = $carrito['id'];
  }
////////////
   // $_SESSION['user_id'] = $usuario_db['id']; // Guardas el ID del usuario en la sesión

    ?>

      <!-- place navbar here -->
      
    </header>


    <main>
      <div>
        <div data-bs-spy="scroll" data-bsx-target="#nav-example" data-bs-smooth-scroll="true" tabindex="0">
          <div id="div1" class="bg-primary" style="height: 90vh !important"> 
          <br>
            <h2 align="center">Bienvenido a Obsidian Rose</h2> 
            <p><?php ?>  </p>
            <br>
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
              <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
              </ol>

              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img src="../assets/anime1.png" class="w-100 d-block" alt="First slide" />
                </div>

                <div class="carousel-item">
                  <img src="../assets/anime2.png" class="w-100 d-block" alt="Second slide"/>
                </div>

                <div class="carousel-item">
                  <img src="../assets/anime3.jpg" class="w-100 d-block" alt="Third slide" />
                </div>

              </div>

              <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev" >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>

              <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

          </div>
          
          <div id="div2" class="bg-success" > 
            <br>
            <h2 align="center">Productos</h2> 
            <br>
              <div class="imgGrid">
                    <?php 
                    $query = "SELECT * FROM productos";
                    $result = $pdo->query($query);

                    while ($producto = $result->fetch(PDO::FETCH_ASSOC)) {
                      $id = htmlspecialchars($producto['id']);
                      $nombre = htmlspecialchars($producto['nombre']);
                      $existencia = htmlspecialchars($producto['existencia']);
                      $precio = htmlspecialchars($producto['precio']);
                      $descripcion = htmlspecialchars($producto['descripcion']);
                      $imagen = base64_encode($producto['imagen']); // Convierte la imagen BLOB a base64
                  
                      // Muestra el producto en HTML
                      echo "
                      <div class='producto' onclick='mostrarCard($producto[id])'>
                          <img src='data:image/jpeg;base64,$imagen' alt='Imagen de $nombre' class='imagen' align='center'/>
                          <h3>$nombre</h3>
                          <p>Stock: $existencia</p>
                          <p>Precio: $$precio</p>
                      
                      </div>
                      
                      <!-- Tarjeta oculta con más información sobre el producto -->
                          <div id='card-$producto[id]' class='producto-card'>
                          <div class='cardTop'> 
                          <h3>Detalles de $nombre</h3>
                            <div class='btnClose'>
                            <button onclick='ocultarCard($producto[id])' class='logoClose'> <img src='../assets/logo.png' class='logo'> </button>
                            </div>
                          </div>

                          <div class=contenido> 
                            <img src='data:image/jpeg;base64,$imagen' alt='Imagen de $nombre' class='imagen_card'/>
                          <div class='informacion'>
                              <h6>$descripcion</h6>
                              <h2 class='precio'>Precio: $$precio</h2>
                              <button onclick='ocultarCard($producto[id])' class='Precio'>Cerrar</button>
                              <form action='../controlador/controladorCarrito.php' method='post'>

                              <input type='hidden' name='producto_id' value='$id'>
                              <input type='hidden' name='nombre' value='$nombre'>
                              <input type='hidden' name='precio' value='$precio'>
                              
                              <button type='submit' class='btn btn-primary' name='carrito'>Agregar a carrito <img src='../assets/cart3.svg' class='carritosvg'></button>
                              </form>
                          </div>
                        </div>
                        </div> 
                      ";
                  }
                    ?>
              </div>
            </div>
            <br>
          
          <br>

          <div id="div3" class="bg-primary" style="height: 100vh">
            <br> 
          <h2 align="center">Nosotros</h2>
          <article>
            <p>Obsidian Rose nació con la misión de romper los moldes convencionales del maquillaje, ofreciendo opciones auténticas y alternativas para quienes buscan expresarse desde una estética más oscura y misteriosa. Inspirada en la elegancia gótica y la profundidad de las sombras, Obsidian Rose redefine el maquillaje como un arte personal y audaz, con tonos intensos, acabados profundos y fórmulas de alta calidad. Nuestra colección está diseñada para quienes desean explorar su lado más enigmático, celebrando la belleza en todas sus formas, desde lo etéreo hasta lo intensamente dramático.</p>
          </article>
          </div>
            
          <div id="div4" class="bg-success" style="height: 100vh">  
            <br>
          <h2 align="center">Contacto</h2>

          </div>
          
        </div>
        </div>
      </div>


    </main>
    <footer>
      <!-- place footer here -->


      
    </footer>




    <!-- Bootstrap JavaScript Libraries -->
    <script>
      // Asegurarse de que la página se recargue desde la parte superior
      window.onload = function() {
        if (window.location.hash) {
          // Si hay un hash en la URL, forzar que la página se desplace hacia arriba
          window.scrollTo(0, 0);
        }
      };


            // Mostrar la tarjeta correspondiente al producto
      function mostrarCard(id) {
          // Ocultar todas las tarjetas
          var cards = document.querySelectorAll('.producto-card');
          cards.forEach(function(card) {
              card.style.display = 'none';
          });

          // Mostrar la tarjeta correspondiente
          var card = document.getElementById('card-' + id);
          if (card) {
              card.style.display = 'block';
          }
      }

      // Ocultar la tarjeta correspondiente al producto
      function ocultarCard(id) {
          var card = document.getElementById('card-' + id);
          if (card) {
              card.style.display = 'none';
          }
      }

    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
