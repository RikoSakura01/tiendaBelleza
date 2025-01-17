<?php
include('../modelo/conexion.php');

echo "bienvenido a controladoLogin.php";

if (isset($_POST['updateUsuario'])){
    //recuperamos los datos insertados en el formulario y lo guardamos en variables
    $id=$_POST["id"];
    $registroNombre=$_POST["registroNombre"];
    $registroApellidoPaterno=$_POST["registroApellidoPaterno"];
    $registroApellidoMaterno=$_POST["registroApellidoMaterno"];
    $registroEmail=$_POST["registroEmail"];
    $registroPass=$_POST["registroPass"];
    $registroIdRol=$_POST["registroIdRol"];
    $hash_password = password_hash(password: $registroPass, algo: PASSWORD_DEFAULT);

    $updateUsuario="UPDATE usuarios SET nombre=:registroNombre,ap_pat=:registroApellidoPaterno,ap_mat=:registroApellidoMaterno,email=:registroEmail,pass=:registroPass,id_rol=:id_rol WHERE id=:id";

    $stmt = $pdo->prepare($updateUsuario);
    $stmt->bindParam(':registroNombre', $registroNombre);
    $stmt->bindParam(':registroApellidoPaterno', $registroApellidoPaterno);
    $stmt->bindParam(':registroApellidoMaterno', $registroApellidoMaterno);
    $stmt->bindParam(':registroEmail', $registroEmail);
    $stmt->bindParam(':registroPass', $hash_password);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':id_rol', $registroIdRol);

    $stmt->execute();
    echo "Update usuario completado";
    //UPDATE tabla SET campo='campo nuevo' WHERE campo=valor;

    $registroCalle=$_POST["registroCalle"];
    $registroNumeroExterior=$_POST["registroNumeroExterior"];
    $registroNumeroInterior=$_POST["registroNumeroInterior"];
    $registroCodigoPostal=$_POST["registroCodigoPostal"];
    $registroAlcaldia=$_POST["registroAlcaldia"];

    $updateDireccion="UPDATE direccion SET calle=:calle,cp=:cp,no_ext=:no_ext,no_int=:no_int,alcaldia=:alcaldia WHERE id IN (SELECT id_direccion FROM usuarios where id=:id)";

    $stmt2 = $pdo->prepare($updateDireccion);
    $stmt2->bindParam(':calle', $registroCalle);
    $stmt2->bindParam(':cp', $registroCodigoPostal);
    $stmt2->bindParam(':no_ext', $registroNumeroExterior);
    $stmt2->bindParam(':no_int', $registroNumeroInterior);
    $stmt2->bindParam(':alcaldia', $registroAlcaldia);
    $stmt2->bindParam(':id', $id);

    $stmt2->execute();
    echo "Update direccion completado";

}elseif(isset($_POST['updateInventario'])){

    $id_producto=$_POST["id_producto"];
    $nombre=$_POST["nombre"];
    $precio=$_POST["precio"];
    $stock=$_POST["stock"];
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    $descripcion=$_POST["descripcion"];
    $id_vendedor=$_POST["id_vendedor"];
    $registroOpcion=$_POST["registroOpcion"];
    
    if ($_POST['registroOpcion'] == '1'){
        echo"OPCION 1: actualizar";
//ACTUALIZAR
    $actualizarInventario="UPDATE productos SET nombre=:nombre, precio=:precio, existencia=:stock,imagen=:imagen,descripcion=:descripcion,vendedor=:vendedor WHERE id=:id_producto";

    $stmt3 = $pdo->prepare($actualizarInventario);
    $stmt3->bindParam(':nombre', $nombre);
    $stmt3->bindParam(':precio', $precio);
    $stmt3->bindParam(':stock', $stock);
    $stmt3->bindParam(':imagen', $imagen);
    $stmt3->bindParam(':descripcion', $descripcion);
    $stmt3->bindParam(':vendedor', $id_vendedor);
    $stmt3->bindParam(':id_producto', $id_producto);
    
    $stmt3->execute();
    header("Location: ../vista/admin.php");

    }elseif ($_POST['registroOpcion'] == '2'){
        echo"OPCION 2: INSERTAR";
//INSERTAR
    $insertarInventario=" INSERT INTO productos (id,nombre,precio,existencia,imagen,descripcion,vendedor) VALUES (:id,:nombre,:precio,:existencia,:imagen,:descripcion,:vendedor)";
    $id_producto='';
    $stmt4 = $pdo->prepare($insertarInventario);
    $stmt4->bindParam(':id', $id_producto);
    $stmt4->bindParam(':nombre', $nombre);
    $stmt4->bindParam(':precio', $precio);
    $stmt4->bindParam(':existencia', $stock);
    $stmt4->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
    $stmt4->bindParam(':descripcion', $descripcion);
    $stmt4->bindParam(':vendedor', $id_vendedor);

    $stmt4->execute();
    header("Location: ../vista/admin.php");

    }
}
?>