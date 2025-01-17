<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link href="../assets/login.css" rel="stylesheet" >
        <link href="../assets/admin.css" rel="stylesheet" >
    </head>
    <?php
    session_start();
    
    include('../modelo/conexion.php');
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php"); // Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
        exit();
    }
    $id_usuario=$_SESSION['user_id'];
    $nombreDeVendedor=$_SESSION['username']
    ?>
    <body>
        <header>
            <!-- place navbar here -->
            <nav id="nav-example" class="navbar navbar-expand navbar-light bg1-dark fixed-top">
                <div class="nav navbar-nav d-flex justify-content-center w-100">
                    <!-- Enlaces centrados -->
                    <a class="nav-link " href="#div1">Inventario general</a>
                    <a class="nav-link text-light" href="#div2">Inventario personal</a>
                    <a class="nav-link text-light" href="#div3">Ventas general</a>
                    <a class="nav-link text-light" href="#div4">Ventas personales</a>

                    
                    <!-- Enlaces a la derecha -->
                    <div class="ms-auto d-flex">
                    <p class="nav-link text-light">Hola <?php echo $nombreDeVendedor;  ?>! </p>
                        <a class="nav-link text-light" href="../controlador/logout.php">Log out</a>
                    </div>
                </div>
            </nav>
        </header>
        <main>
        <div>
        <div data-bs-spy="scroll" data-bsx-target="#nav-example" data-bs-smooth-scroll="true" tabindex="0">

        <div id="div1" class="bg-primary" > 
            <br>
            <h2 align="center">Inventario general</h2> 
            <div class="contenedor">
                      <br>
                      <?php 
                      $queryUsuarios = "SELECT productos.id as id, productos.nombre as nombre, productos.precio as precio, productos.existencia as stock, productos.imagen as imagen, CONCAT(usuarios.nombre,' ', usuarios.ap_pat, ' ', usuarios.ap_mat) as Vendedor FROM productos,usuarios where productos.vendedor=usuarios.id ORDER BY productos.id ";
                      $stmt = $pdo->prepare($queryUsuarios);
                      $stmt->execute();
                      $resultUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      // Inicia la tabla y coloca el encabezado fuera del bucle
                      echo "<table class='tablaVendedor'>
                              <tr>
                                  <td>Id</td>
                                  <td>Nombre</td>
                                  <td>Precio</td>
                                  <td>Stock</td>
                                  <td>Imagen</td>
                                  <td>Vendedor</td>
                              </tr>";

                      // Itera sobre los resultados y agrega cada fila a la tabla
                      foreach ($resultUsuarios as $resultUsuario) {
                          $id = htmlspecialchars($resultUsuario['id']);
                          $nombre = htmlspecialchars($resultUsuario['nombre']);
                          $precio = htmlspecialchars($resultUsuario['precio']);
                          $stock = htmlspecialchars($resultUsuario['stock']);
                          $imagen = base64_encode($resultUsuario['imagen']);
                          $vendedor = htmlspecialchars($resultUsuario['Vendedor']);


                          echo "<tr>
                                  <td>$id</td>
                                  <td>$nombre</td>
                                  <td>$precio</td>
                                  <td>$stock</td>
                                  <td><img src='data:image/jpeg;base64,$imagen' class='imagen' align='center'/></td>
                                  <td>$vendedor</td>
                                </tr>";
                      }

                      // Cierra la tabla
                      echo "</table>";
                      ?>
                      <br>
                      </div>
        </div>
          
        <div id="div2" class="bg-success" > 
            <br>
            <h2 align="center">Inventario personal</h2> 
            <div class="contenedor">
                      <br>
                      <?php 
                      //$id_usuario
                      
                      $queryUsuarios = "SELECT productos.id as id, productos.nombre as nombre, productos.precio as precio, productos.existencia as stock, productos.imagen as imagen, CONCAT(usuarios.nombre,' ', usuarios.ap_pat, ' ', usuarios.ap_mat) as Vendedor FROM productos,usuarios where productos.vendedor=usuarios.id AND usuarios.id=:id_usuario ORDER BY productos.id ";
                      $stmt = $pdo->prepare($queryUsuarios);
                      $stmt->bindParam(':id_usuario', $id_usuario);
                      $stmt->execute();
                      $resultUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      // Inicia la tabla y coloca el encabezado fuera del bucle
                      echo "<table class='tablaVendedor'>
                              <tr>
                                  <td>Id</td>
                                  <td>Nombre</td>
                                  <td>Precio</td>
                                  <td>Stock</td>
                                  <td>Imagen</td>
                                  <td>Vendedor</td>
                              </tr>";

                      // Itera sobre los resultados y agrega cada fila a la tabla
                      foreach ($resultUsuarios as $resultUsuario) {
                          $id = htmlspecialchars($resultUsuario['id']);
                          $nombre = htmlspecialchars($resultUsuario['nombre']);
                          $precio = htmlspecialchars($resultUsuario['precio']);
                          $stock = htmlspecialchars($resultUsuario['stock']);
                          $imagen = base64_encode($resultUsuario['imagen']);
                          $vendedor = htmlspecialchars($resultUsuario['Vendedor']);

                          echo "<tr>
                                  <td>$id</td>
                                  <td>$nombre</td>
                                  <td>$precio</td>
                                  <td>$stock</td>
                                  <td><img src='data:image/jpeg;base64,$imagen' class='imagen' align='center'/></td>
                                  <td>$vendedor</td>
                                </tr>";
                      }

                      // Cierra la tabla
                      echo "</table>";
                      ?>
                      <br>
                      </div>
             
        </div>


        <div id="div3" class="bg-primary" > 
        <br>
            <h2 align="center">Ventas general</h2> 
            <br>
            <?php 
                  $consultaVentas="SELECT ventas.id,productos.nombre as producto ,ventas.cantidad as cantidad,CONCAT (comprador.nombre,' ',comprador.ap_pat,' ',comprador.ap_mat) as comprador,vendedor.nombre as vendedor,productos.precio as precioUnitario FROM ventas JOIN productos ON ventas.id_producto=productos.id JOIN usuarios AS comprador ON ventas.id_comprador=comprador.id AND comprador.id_rol=3 JOIN usuarios AS vendedor ON ventas.id_vendedor=vendedor.id AND vendedor.id_rol=2";
                  $stmt8 = $pdo->prepare($consultaVentas);
                  $stmt8->execute();
                  $resultVentas = $stmt8->fetchAll(PDO::FETCH_ASSOC);
                  
                        // Inicia la tabla y coloca el encabezado fuera del bucle
                      echo "<table class='tablaVendedor'>
                      <tr>
                          <td>Id</td>
                          <td>Productos</td>
                          <td>Cantidad</td>
                          <td>Comprador</td>
                          <td>Vendedor</td>
                          <td>Precio unitario</td>
                          <td>Precio total</td>
                      </tr>";

              // Itera sobre los resultados y agrega cada fila a la tabla
              foreach ($resultVentas as $resultsVentas) {
                  $id = htmlspecialchars($resultsVentas['id']);
                  $productos = htmlspecialchars($resultsVentas['producto']);
                  $cantidad = htmlspecialchars($resultsVentas['cantidad']);
                  $comprador = htmlspecialchars($resultsVentas['comprador']);
                  $vendedor = htmlspecialchars($resultsVentas['vendedor']);
                  $precioUnitario = htmlspecialchars($resultsVentas['precioUnitario']);
                  $precioTotal=$cantidad*$precioUnitario;  
                  echo "<tr>
                          <td>$id</td>
                          <td>$productos</td>
                          <td>$cantidad</td>
                          <td>$comprador</td>
                          <td>$vendedor</td>
                          <td>$precioUnitario</td>
                        <td>$precioTotal</td>   
                        </tr>";
              }

              // Cierra la tabla
              echo "</table>";
                  
                    ?>
        </div>

        <div id="div4" class="bg-success" > 
        <br>
            <h2 align="center">Ventas personales</h2> 
            <br>
            <?php 
                  $consultaVentas="SELECT ventas.id,productos.nombre as producto ,ventas.cantidad as cantidad,CONCAT (comprador.nombre,' ',comprador.ap_pat,' ',comprador.ap_mat) as comprador,vendedor.nombre as vendedor,productos.precio as precioUnitario FROM ventas JOIN productos ON ventas.id_producto=productos.id JOIN usuarios AS comprador ON ventas.id_comprador=comprador.id AND comprador.id_rol=3 JOIN usuarios AS vendedor ON ventas.id_vendedor=vendedor.id AND vendedor.id_rol=2 AND vendedor.id=:id_usuario";
                  $stmt8 = $pdo->prepare($consultaVentas);
                  $stmt8->bindParam(':id_usuario', $id_usuario);
                  $stmt8->execute();
                  $resultVentas = $stmt8->fetchAll(PDO::FETCH_ASSOC);
                  
                        // Inicia la tabla y coloca el encabezado fuera del bucle
                      echo "<table class='tablaVendedor'>
                      <tr>
                          <td>Id</td>
                          <td>Productos</td>
                          <td>Cantidad</td>
                          <td>Comprador</td>
                          <td>Vendedor</td>
                          <td>Precio unitario</td>
                          <td>Precio total</td>
                      </tr>";

              // Itera sobre los resultados y agrega cada fila a la tabla
              foreach ($resultVentas as $resultsVentas) {
                  $id = htmlspecialchars($resultsVentas['id']);
                  $productos = htmlspecialchars($resultsVentas['producto']);
                  $cantidad = htmlspecialchars($resultsVentas['cantidad']);
                  $comprador = htmlspecialchars($resultsVentas['comprador']);
                  $vendedor = htmlspecialchars($resultsVentas['vendedor']);
                  $precioUnitario = htmlspecialchars($resultsVentas['precioUnitario']);
                  $precioTotal=$cantidad*$precioUnitario;  
                  echo "<tr>
                          <td>$id</td>
                          <td>$productos</td>
                          <td>$cantidad</td>
                          <td>$comprador</td>
                          <td>$vendedor</td>
                          <td>$precioUnitario</td>
                        <td>$precioTotal</td>   
                        </tr>";
              }

              // Cierra la tabla
              echo "</table>";
                  
                    ?>
                    <br>
        </div>


        </div>
        </div>




        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
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
