<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
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

    ?>
    <body>
        <header>
            <!-- place navbar here -->
            <nav id="nav-example" class="navbar navbar-expand navbar-light bg1-dark fixed-top">
                <div class="nav navbar-nav d-flex justify-content-center w-100">
                    <!-- Enlaces centrados -->
                    <a class="nav-link " href="#div1">Home</a>
                    <a class="nav-link text-light" href="#div2">Registrar personas</a>
                    <a class="nav-link text-light" href="#div3">Vendedores</a>
                    <a class="nav-link text-light" href="#div4">Clientes</a>
                    <a class="nav-link text-light" href="#div5">Inventario</a>
                    <a class="nav-link text-light" href="#div6">Modificar inventario</a>
                    <a class="nav-link text-light" href="#div7">Modificar Usuarios</a>
                    <a class="nav-link text-light" href="#div8">Ventas</a>

                    <!-- Enlaces a la derecha -->
                    <div class="ms-auto d-flex">
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
                    <h2 align="center">Bienvenido</h2>   
                    <br>
                    <br>
                  </div>
                  
                  <div id="div2" class="bg-success" style="height: 100vh"> 
                    <br>
                    <h2 align="center">Registrar</h2> 
                    <div class="table-responsive-md">
                        <form class="formLogIn" action="../controlador/controladorLogin.php" method="post">
                            <table class="registoUsuarios">
                                <tr>
                                    <td><div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="registroNombre">
                                        </div>
                                    </td>
                                    <td><div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="registroApellidoPaterno">
                                        </div>
                                    </td>
                                    <td><div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="registroApellidoMaterno">
                                      </div></td>
                                
                                    <td><div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputPassword1" name="registroEmail">
                                    </div></td>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" name="registroPass">
                                            </div>
                                    </td>
                                </tr> 
                                
                                    
                                
                                <tr>
                                    <th><h3>Direccion</h3></th><br>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Calle</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="registroCalle">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Codigo Postal</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="registroNumeroExterior">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Numero exterior</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="registroNumeroInterior">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Codigo interior</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="registroCodigoPostal">
                                        </div>
                                    </td>
                                    <td>
                                            <label for="alcaldia">Selecciona tu alcaldía:</label>
                                            <select id="alcaldia" name="registroAlcaldia">
                                              <option value="">Selecciona una opción</option>
                                              <option value="Álvaro Obregón">Álvaro Obregón</option>
                                              <option value="Azcapotzalco">Azcapotzalco</option>
                                              <option value="Benito Juárez">Benito Juárez</option>
                                              <option value="Coyoacán">Coyoacán</option>
                                              <option value="Cuajimalpa de Morelos">Cuajimalpa de Morelos</option>
                                              <option value="Cuauhtémoc">Cuauhtémoc</option>
                                              <option value="Gustavo A. Madero">Gustavo A. Madero</option>
                                              <option value="Iztacalco">Iztacalco</option>
                                              <option value="Iztapalapa">Iztapalapa</option>
                                              <option value="La Magdalena Contreras">La Magdalena Contreras</option>
                                              <option value="Miguel Hidalgo">Miguel Hidalgo</option>
                                              <option value="Milpa Alta">Milpa Alta</option>
                                              <option value="Tláhuac">Tláhuac</option>
                                              <option value="Tlalpan">Tlalpan</option>
                                              <option value="Venustiano Carranza">Venustiano Carranza</option>
                                              <option value="Xochimilco">Xochimilco</option>
                                            </select>                            
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="alcaldia">Seleccion el rol:</label>
                                        <select id="alcaldia" name="registroIdRol">
                                            <option value="">Seleccion el rol:</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Vendedor</option>    
                                            <option value="3">General</option>    
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary" name="registro">Submit</button>
                                    </td>
                                </tr> 
                            </table>
                            <br>
                        </form>
                    </div>
                  </div>

                  <div id="div3" class="bg-primary" style="height: 100vh">
                    <br> 
                  <h2 align="center">Vendedores</h2>
                  <br>
                  <div>
                  <?php 
                      $queryUsuarios = "SELECT id, CONCAT(nombre,' ',ap_pat,' ',ap_mat) as Nombre, email FROM usuarios WHERE id_rol=2";
                      $stmt = $pdo->prepare($queryUsuarios);
                      $stmt->execute();
                      $resultUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      // Inicia la tabla y coloca el encabezado fuera del bucle
                      echo "<table class='tablaVendedor'>
                              <tr>
                                  <td>Id</td>
                                  <td>Nombre</td>
                                  <td>Email</td>
                              </tr>";

                      // Itera sobre los resultados y agrega cada fila a la tabla
                      foreach ($resultUsuarios as $resultUsuario) {
                          $id = htmlspecialchars($resultUsuario['id']);
                          $nombre = htmlspecialchars($resultUsuario['Nombre']);
                          $email = htmlspecialchars($resultUsuario['email']);

                          echo "<tr>
                                  <td>$id</td>
                                  <td>$nombre</td>
                                  <td>$email</td>
                                </tr>";
                      }

                      // Cierra la tabla
                      echo "</table>";
                      ?>

                  </div>
                  <br>
                  <br>
                  </div> <!-- FIN id="div3" class="bg-primary" -->

                  <div id="div4" class="bg-success" style="height: 100vh">  
                    <br>
                  <h2 align="center">Clientes</h2>
                  <br>
                      <div class="container">
                      <?php 
                      $queryUsuarios = "SELECT id, CONCAT(nombre,' ',ap_pat,' ',ap_mat) as Nombre, email FROM usuarios WHERE id_rol=3";
                      $stmt = $pdo->prepare($queryUsuarios);
                      $stmt->execute();
                      $resultUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      // Inicia la tabla y coloca el encabezado fuera del bucle
                      echo "<table class='tablaVendedor'>
                              <tr>
                                  <td>Id</td>
                                  <td>Nombre</td>
                                  <td>Email</td>
                              </tr>";

                      // Itera sobre los resultados y agrega cada fila a la tabla
                      foreach ($resultUsuarios as $resultUsuario) {
                          $id = htmlspecialchars($resultUsuario['id']);
                          $nombre = htmlspecialchars($resultUsuario['Nombre']);
                          $email = htmlspecialchars($resultUsuario['email']);

                          echo "<tr>
                                  <td>$id</td>
                                  <td>$nombre</td>
                                  <td>$email</td>
                                </tr>";
                      }

                      // Cierra la tabla
                      echo "</table>";
                      ?>
                      <br>
                      <br>
                      </div>
                  </div><!-- FIN id="div4" class="bg-success" -->
        
                  <div id="div5" class="bg-primary" >  
                    <br>
                  <h2 align="center">Inventario</h2>
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

                  <div id="div6" class="bg-success" style="height: 150vh !important">  
                    <br>
                  <h2 align="center">Modificar Inventario</h2>
                  <br>
                  <br>
                  <button onclick="mostrarInput()" style="margin-left:70vh;margin-right:20px;">Actualizar producto</button>
                  <button onclick="ocultarInput()">Insertar producto</button>
                  <br>
                  <br>
                  <form action="../controlador/controladorAdmin.php" method="post" enctype="multipart/form-data" id="form" style="            display: none;
">
                    <table class="updateInventario">
                      <tr>
                        <td id="oculto"><div class="mb-3">
                                        <label for="solicitaID" class="form-label">Id</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="id_producto">
                                        </div></td>
                                        
                                        
                        <td><div class="mb-3">
                                        <label for="Nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nombre">
                                        </div></td>
                        <td><div class="mb-3">
                                        <label for="Precio" class="form-label">Precio</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="precio">
                                        </div></td>
                        <td><div class="mb-3">
                                        <label for="Stock" class="form-label">Stock</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="stock">
                                        </div></td>
                      </tr>
                      <tr>
                        
                        <td><div class="mb-3">
                                        <label for="Imagen" class="form-label">Imagen</label>
                                        <input type="file" name="imagen" id="imagen" accept="image/*" required>
                                        </div></td>
                        <td><div class="mb-3">
                                        <label for="Descripcion" class="form-label">Descripcion</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="descripcion">
                                        </div></td>
                        <td><div class="mb-3">
                                        <label for="Vendedor" class="form-label">Vendedor</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="id_vendedor">
                                        </div></td>  
                        <td><div class="mb-3">
                                        <label for="alcaldia" >Confirma la accion a realizar:</label>
                                                        <select  id="alcaldia" name="registroOpcion">
                                                            <option value="1">Actualizar</option>
                                                            <option value="2">Insertar</option>    
                                                        </select>
                                        </div></td>
                                          
                                       
                        <td><div class="mb-3">
                                        <button type="submit" class="btn btn-primary" name="updateInventario">Submit</button>
                                        </div></td>                                           
                      </tr>
                    </table>
                  </form>
                  <script>
                                            function mostrarInput() {
                                                //actualizar
                                                document.getElementById("oculto").style.display = "block";
                                                document.getElementById("form").style.display = "block";
                                            }

                                            // Función para ocultar el input
                                            function ocultarInput() {
                                                //insertar
                                                document.getElementById("oculto").style.display = "none";
                                                document.getElementById("form").style.display = "block";
                                            }
                                        </script>
                  </div>

                  <div id="div7" class="bg-primary" style="height: 150vh !important">  
                    <br>
                  <h2 align="center">Modificar Usuarios</h2>
                  <div class="table-responsive-md">
                        <form class="formLogIn" action="../controlador/controladorAdmin.php" method="post">
                            <table class="registoUsuarios">
                                <tr>
                                <td><div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Id</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="id">
                                        </div>
                                    </td>
                                    <td><div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="registroNombre">
                                        </div>
                                    </td>
                                    <td><div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Apellido paterno</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="registroApellidoPaterno">
                                        </div>
                                    </td>
                                    <td><div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Apellido materno</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="registroApellidoMaterno">
                                      </div></td>
                                
                                    <td><div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputPassword1" name="registroEmail">
                                    </div></td>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" name="registroPass">
                                            </div>
                                    </td>
                                </tr> 
                                
                                    
                                
                                <tr>
                                    <th><h3>Direccion</h3></th><br>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Calle</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="registroCalle">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Codigo Postal</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="registroCodigoPostal">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Numero exterior</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="registroNumeroExterior">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Codigo interior</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" name="registroNumeroInterior">
                                        </div>
                                    </td>
                                    <td>
                                            <label for="alcaldia">Selecciona tu alcaldía:</label>
                                            <select id="alcaldia" name="registroAlcaldia">
                                              <option value="">Selecciona una opción</option>
                                              <option value="Álvaro Obregón">Álvaro Obregón</option>
                                              <option value="Azcapotzalco">Azcapotzalco</option>
                                              <option value="Benito Juárez">Benito Juárez</option>
                                              <option value="Coyoacán">Coyoacán</option>
                                              <option value="Cuajimalpa de Morelos">Cuajimalpa de Morelos</option>
                                              <option value="Cuauhtémoc">Cuauhtémoc</option>
                                              <option value="Gustavo A. Madero">Gustavo A. Madero</option>
                                              <option value="Iztacalco">Iztacalco</option>
                                              <option value="Iztapalapa">Iztapalapa</option>
                                              <option value="La Magdalena Contreras">La Magdalena Contreras</option>
                                              <option value="Miguel Hidalgo">Miguel Hidalgo</option>
                                              <option value="Milpa Alta">Milpa Alta</option>
                                              <option value="Tláhuac">Tláhuac</option>
                                              <option value="Tlalpan">Tlalpan</option>
                                              <option value="Venustiano Carranza">Venustiano Carranza</option>
                                              <option value="Xochimilco">Xochimilco</option>
                                            </select>                            
                                    </td>
                                    <td>
                                        <label for="alcaldia">Seleccion el rol:</label>
                                        <select id="alcaldia" name="registroIdRol">
                                            <option value="">Seleccion el rol:</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Vendedor</option>    
                                            <option value="3">General</option>    
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                        <button type="submit" class="btn btn-primary" name="updateUsuario">Submit</button>
                                    </td>
                                </tr> 
                            </table>
                            <br>
                        </form>
                    </div>


                  </div>


                  <div id="div8" class="bg-success" >  
                    <br>
                  <h2 align="center">Ventas</h2>
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

                    <br>
                    <br>
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
