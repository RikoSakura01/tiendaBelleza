<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
        <link href="../assets/carroputo.css" rel="stylesheet" >


    </head>

    <body>
    <?php 
    
        include('../modelo/conexion.php');
        include('navbar.php'); 

        $_SESSION['id_usuario'];

        $id_usuario=$_SESSION['id_usuario']; // Guardas el ID del usuario en la sesión
        if (!isset($_SESSION['id_usuario'])) {
            echo"FALSE";
            header("Location: index.php"); // Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
            exit();
        }


        //$id_carrito=$_SESSION['carrito_id'];        
        //$id_usuario=$_SESSION['id_usuario']; 
        //recupera de la sesion anterior

        //$_SESSION['carrito_id'] = $carrito['id']; //guardo desde controlador carrito
        //$id_carrito=$_SESSION['carrito_id'];
        $consultaCarro = "SELECT id FROM carrito WHERE id_usuario=:id_usuario";
        $stmt0 = $pdo->prepare($consultaCarro);
        $stmt0->bindParam(':id_usuario', $id_usuario);
        $stmt0->execute();
        $carrito = $stmt0->fetch(PDO::FETCH_ASSOC);
        if ($carrito){
            $id_carrito = $carrito['id']; 
        }
    ?>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
       
            <!-- Log in-->
            <div id="div1" class="bg-success" style="height: 100vh"> 
                <br>
                <h1><?php $id_usuario  ?></h1>
                <h1>Bienvenido a tu carrito <?php $id_carrito ?></h1>
                <div class="prodcutosCarrito">
                <?php 

                    $productosCarro = "SELECT p.nombre, p.precio, p.imagen, p.id, COUNT(*) AS cantidad FROM productos AS p JOIN carrito_productos AS cp ON p.id = cp.id_productos WHERE cp.id_carrito =:id_carrito GROUP BY p.nombre, p.precio ORDER BY p.nombre ASC;
                    ";
                    $stmt = $pdo->prepare($productosCarro);
                    $stmt->bindParam(':id_carrito', $id_carrito);
                    $stmt->execute();
                    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                            <div class="contenido">
                                <div class="tabla1">
                                    <?php 
                                     foreach ($productos as $producto):
                                        $nombre = htmlspecialchars($producto['nombre']);
                                        $precio = htmlspecialchars($producto['precio']);
                                        $imagen = base64_encode($producto['imagen']); // Convierte la imagen BLOB a base64
                                        $cantidad = htmlspecialchars($producto['cantidad']);
                                        $id_prod = htmlspecialchars($producto['id']);

                                    ?>
                                <table class="informacion">
                                    <tr>
                                        <td class='imagen'></td>
                                        <td class="vacio"></td>
                                        <td class='nombre'>Nombre</td>
                                        <td class='precio'>Precio</td>
                                        <td class='cantidad'>Cantidad</td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                    <?php
                                    echo"
                                        <td class='imagenProducto'><img src='data:image/jpeg;base64,$imagen' class='imagen' align='center'/></td>
                                        <td class='vacio'></td>
                                        <td class='nombre'> $nombre </td>
                                        <td class='precio'>$$precio  </td>
                                        <td class='cantidad'> $cantidad  </td>
                                        <td>
                                            <form action='../controlador/controladorCarrito.php' method='post'>
                                                <input type='hidden' name='id_carrito' value='$id_carrito'>
                                                <input type='hidden' name='id_prod' value='$id_prod'>    
                                                <button type='submit' name='accion' value='agregar' id='botonAncla'>Agregar</button>
                                                <button type='submit' name='accion' value='borrar'>Borrar  </button>
                                            </form>
                                        </td>
                                        ";
                                    ?>
                                    </tr>
                                </table>
                                <?php 
                                    endforeach;
                                ?> 
                                <form action="../controlador/controladorCarrito.php" method='post'>
                                    <input type='hidden' name='id_carrito' value='<?php echo $id_carrito; ?>'>  
                                    <input type='hidden' name='id_comprador' value='<?php echo $id_usuario; ?>'>  
                                    <button type='submit' name='accion' value='actualizarStock'>Comprar todo</button>
                                </form>
                                </div>
                            </div>
                </div>
            
            </div>
            
<!-- ///////////////////////  Registro /////////////////////////////////////////////////////////-->

            
            <div id="div2" class="bg-primary" style="height: 100vh"> 
                <br>
                <h1></h1>
             
            </div>
            
            <div id="div3" class="bg-success" style="height: 100vh">         
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
