<?php 
include('../modelo/conexion.php');
echo "Bienvenido a controladorCarrito.php";
session_start();


//agregar a carrito el prodcuto seleccionado

    //PASO 1Recuperar el id del carro del usaurio
if (isset($_POST['carrito'])){
    $id_usuario=$_SESSION['id_usuario']; //recupera de la sesion anterior
    $nombre=$_SESSION['nombre_usuario'];
    echo $nombre;
    echo $id_usuario;
$query = "SELECT id FROM carrito where id_usuario = :id_usuario";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_usuario',$id_usuario);
$stmt->execute();
$carrito = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['id_carro'] = $carrito['id'];
echo "Primer carro id: ";
echo $_SESSION['id_carro'];

if($carrito){
    echo "paso el if, si retorna datos";

    //PASO 2 Insertar el prodcuto en el carro 

//Variables para insertar en carro
$id='';
$id_carrito=$carrito['id'];
$id_productos = $_POST['producto_id'];

echo "Carrito: ";
echo $id_carrito;
echo "\nProdcuto: ";
echo $id_productos;

$insertarCarrito="INSERT INTO carrito_productos (id,id_carrito,id_productos) VALUES(:id, :id_carrito, :id_productos)";

$stmt2 = $pdo->prepare($insertarCarrito);
$stmt2->bindParam(':id',$id);
$stmt2->bindParam(':id_carrito',$id_carrito);
$stmt2->bindParam(':id_productos',$id_productos);
$stmt2->execute();

$_SESSION['carrito_id'] = $carrito['id']; //guardo desde controlador carrito

echo 'Agregado al carrito correctamente';
header("Location: ../vista/index.php");
}else{
    echo 'No retorna nada';
}

   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //         B O R R A R   D E    C A R R O                  B O R R A R   D E    C A R R O          B O R R A R   D E    C A R R O
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}if ($_POST['accion'] == 'borrar'){
    echo"<br>\nBienvenido a la opcion BORRAR<br>";

    $id_prod=$_POST["id_prod"];
    $id_carrito=$_POST["id_carrito"];

    echo"\nProducto: $id_prod";
    echo"\nCarrito: $id_carrito";

    $borrarUnProdcuto="DELETE FROM carrito_productos WHERE id_carrito=:id_carrito AND id_productos=:id_prod LIMIT 1";
    $stmt5 = $pdo->prepare($borrarUnProdcuto);

    $stmt5->bindParam(':id_carrito', var: $id_carrito);
    $stmt5->bindParam(':id_prod', var: $id_prod);

    echo"\nProducto BORRADO con exito";
    $stmt5->execute();
    header("Location: ../vista/carro.php#botonAncla");

    

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //         A G R E G A R    A    C A R R O                  A G R E G A R    A    C A R R O          A G R E G A R    A    C A R R O
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif ($_POST['accion'] == 'agregar'){
    echo"<br>Bienvenido a la opcion AGREGAR<br>";

    $id_base='';
    $id_prod=$_POST["id_prod"];
    $id_carrito=$_POST["id_carrito"];


    echo"\nProducto: $id_prod";
    echo"\nCarrito: $id_carrito";

    $agregarUnProdcuto="INSERT INTO carrito_productos (id, id_carrito,id_productos) VALUES(:id_base,:id_carrito,:id_prod) ";
    $stmt6 = $pdo->prepare($agregarUnProdcuto);

    $stmt6->bindParam(':id_base', var: $id_base);
    $stmt6->bindParam(':id_carrito', var: $id_carrito);
    $stmt6->bindParam(':id_prod', var: $id_prod);

    echo"\nProducto AGREGADO con exito";
    //Borra LA CANTIDAD DE 1 EN UN PRODUCTO
    $stmt6->execute();
    header("Location: ../vista/carro.php#botonAncla");


 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //         A C T U A L I Z A R      S T O C K                  A C T U A L I Z A R      S T O C K          A C T U A L I Z A R      S T O C K
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}elseif ($_POST['accion'] == 'actualizarStock') {
    echo "<br>Bienvenido a la opción COMPRAR TODO<br>";

    // Obtener id_carrito del POST
    $id_carrito = $_POST["id_carrito"];
    $id_comprador = $_POST["id_comprador"];
    $id_venta='';
    // Paso 1: Consultar todos los productos en el carrito del usuario
    $productosCarro = "SELECT p.id, COUNT(*) AS cantidad,vendedor,precio FROM productos AS p JOIN carrito_productos AS cp ON p.id = cp.id_productos WHERE cp.id_carrito =:id_carrito GROUP BY p.nombre, p.precio ORDER BY p.nombre ASC;";

    $stmt7 = $pdo->prepare($productosCarro);
    $stmt7->bindParam(':id_carrito', $id_carrito);
    $stmt7->execute();
    $productos = $stmt7->fetchAll(PDO::FETCH_ASSOC);

    // Paso 2: Preparar la consulta de actualización del stock
    $BorrarStockUnProdcuto = "UPDATE productos SET existencia = existencia - :cantidad WHERE id = :id_prod";
    $stmtUpdate = $pdo->prepare($BorrarStockUnProdcuto);

    //Preparar consulta para BORRAR PRODUCTOS
    $borrarCarrito="DELETE FROM carrito_productos WHERE id_carrito=:id_carrito AND id_productos=:id_prod ";
    $stmtBorrar = $pdo->prepare($borrarCarrito);

    //Preparar consulta para INSERTAR VENTAS
    $insertarVentas="INSERT INTO ventas (id,id_producto,cantidad,id_comprador,id_vendedor,precio_unitario) VALUES (:id,:id_producto,:cantidad,:id_comprador,:id_vendedor,:precio_unitario)";
    $stmtVentas = $pdo->prepare($insertarVentas);
    
    // Paso 3: Ejecutar la actualización para cada producto
    foreach ($productos as $producto) {
        $id_prod = $producto['id'];
        $cantidad = $producto['cantidad'];
        $id_vendedor = $producto['vendedor'];
        $precio = $producto['precio'];


        //Parametros para INSERTAR VENTA
        $stmtVentas->bindParam(':id', $id_venta);
        $stmtVentas->bindParam(':id_producto', $id_prod);
        $stmtVentas->bindParam(':cantidad', $cantidad);
        $stmtVentas->bindParam(':id_comprador', $id_comprador);
        $stmtVentas->bindParam(':id_vendedor', $id_vendedor);
        $stmtVentas->bindParam(':precio_unitario', $precio);
        $stmtVentas->execute();

        // Parametros para ACTUALIZAR STOCK
        $stmtUpdate->bindParam(':cantidad', $cantidad);
        $stmtUpdate->bindParam(':id_prod', $id_prod);
        $stmtUpdate->execute();

        // Parametros para BORRAR CARRO
        $stmtBorrar->bindParam(':id_carrito', $id_carrito);
        $stmtBorrar->bindParam(':id_prod', $id_prod);
        $stmtBorrar->execute();
    }

    echo "<br>Todos los productos del carrito fueron comprados y su stock fue actualizado con éxito.";
    
    // Redirigir al carrito después de la compra
    header("Location: ../vista/carro.php");
    exit;
}else{
    echo"No hagas nada";
}
?>