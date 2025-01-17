<?php
include('../modelo/conexion.php');

echo "bienvenido a controladoLogin.php";

if (isset($_POST['login'])){
    //Rol    1=admin   2=vendedor  3=general    
    echo "Estas haciendo login";

    $emailLogin=$_POST["emailLogin"];
    $passLogin=$_POST["passLogin"];

    $validar_usuario = "SELECT * FROM usuarios WHERE email = :emailLogin";

    $stmt1=$pdo->prepare($validar_usuario);
    $stmt1->bindParam(':emailLogin',$emailLogin);
    $stmt1->execute();
    $usuario_db = $stmt1->fetch(PDO::FETCH_ASSOC);

    if($usuario_db){
        $hash_password=$usuario_db['pass'];
        if(password_verify($passLogin,$hash_password)){
            //Si conincide el password
            switch ($usuario_db['id_rol']) {
                case 1://admin
                    session_start();
                        $_SESSION['user_id'] = $usuario_db['id']; // Guardas el ID del usuario en la sesión
                        $_SESSION['username'] = $usuario_db['nombre']; // O cualquier dato adicional   
                    header("Location: ../vista/admin.php");
                    break;
                case 2://vendedor
                    session_start(); // Inicia la sesión
                        $_SESSION['user_id'] = $usuario_db['id']; // Guardas el ID del usuario en la sesión
                        $_SESSION['username'] = $usuario_db['nombre']; // O cualquier dato adicional   
                    header("Location: ../vista/vendedor.php");
                    break;
                case 3://general
                    session_start();
                    $_SESSION['id_usuario'] = $usuario_db['id']; //Guarda el dato en la
                    echo $_SESSION['id_usuario'];
                    $_SESSION['nombre_usuario'] = $usuario_db['nombre'];
                    header("Location: ../vista/index.php");
                    break;

                default:
                    echo "Rol no reconocido.";
                    break;
            }
        }else{
            //Error no coincide
            echo("Password incorrecto");
            header(header: "refresh:3;url=../vista/login.html");
        }
    }else{
        echo("Usuario no encontrado");
        header("refresh:3;url=../vista/login.html");
    }

//name="emailLogin"
//name="passLogin"


}elseif(isset($_POST['registro'])){

    echo "Estas Creando un usuario";

    $referer = $_SERVER['HTTP_REFERER'] ?? '';


////////////////////////////// Verificar la página de origen para definir un rol////////////////////////////////

echo "\nantes del if de rol";

    if (strpos($referer, 'login.php') !== false) {
            // Si la página de origen contiene 'pagina1.php', hacer una cosa
            echo "\nAccedido desde login.php";

            // Lógica aquí para la acción correspondiente
            $numero_rol=3;
            //inicia logica de insert usuarios
                                        ///////Datos Direccion
                                $id_direccion='';
                                $registroCalle=$_POST["registroCalle"];
                                $registroNumeroExterior=$_POST["registroNumeroExterior"];
                                $registroNumeroInterior=$_POST["registroNumeroInterior"];
                                $registroCodigoPostal=$_POST["registroCodigoPostal"];
                                $registroAlcaldia=$_POST["registroAlcaldia"];

                            ///////Datos Usuario
                                $id_user='';
                                $registroNombre=$_POST["registroNombre"];
                                $registroApellidoPaterno=$_POST["registroApellidoPaterno"];
                                $registroApellidoMaterno=$_POST["registroApellidoMaterno"];
                                $registroEmail=$_POST["registroEmail"];
                                $registroPass=$_POST["registroPass"];
                                $registroid_rol=$numero_rol;

                                ///////  Procesamiento de datos Direccion //////////////////////


                                //Encriptacon hash
                                $hash_password = password_hash(password: $registroPass, algo: PASSWORD_DEFAULT);

                                //Insert de la direccion
                                $crearDireccion="INSERT INTO direccion (id,calle,cp,no_ext,no_int,alcaldia) VALUES(:id_direccion, :registroCalle, :registroNumeroExterior, :registroNumeroInterior, :registroCodigoPostal, :registroAlcaldia)";

                                //preparamos consulta
                                $stmt = $pdo->prepare($crearDireccion);

                                //Valor a parameteros
                                $stmt->bindParam(':id_direccion', $id_direccion);
                                $stmt->bindParam(':registroCalle', $registroCalle);
                                $stmt->bindParam(':registroNumeroExterior', $registroNumeroExterior);
                                $stmt->bindParam(':registroNumeroInterior', $registroNumeroInterior);
                                $stmt->bindParam(':registroCodigoPostal', $registroCodigoPostal);
                                $stmt->bindParam(':registroAlcaldia', $registroAlcaldia);
                                $stmt->execute();


                            ////////////////////  Procesamiento de datos Usuario //////////////////////

                                $id_dir = $pdo->lastInsertId();

                                $crearUsuario="INSERT INTO usuarios (id,nombre,ap_pat,ap_mat,email,id_direccion,id_rol,pass) VALUES(:id_user, :registroNombre, :registroApellidoPaterno, :registroApellidoMaterno, :registroEmail, :id_dir, :registroid_rol, :registroPass)";

                                $stmt2 = $pdo->prepare($crearUsuario);

                                $stmt2->bindParam(':id_user', $id_user);
                                $stmt2->bindParam(':registroNombre', $registroNombre);
                                $stmt2->bindParam(':registroApellidoPaterno', $registroApellidoPaterno);
                                $stmt2->bindParam(':registroApellidoMaterno', $registroApellidoMaterno);
                                $stmt2->bindParam(':registroEmail', $registroEmail);
                                $stmt2->bindParam(':id_dir', $id_dir);
                                $stmt2->bindParam(':registroid_rol', $registroid_rol);
                                //cambiamos a la variable donde la encriptamos a hash en la linea: 
                                $stmt2->bindParam(':registroPass', $hash_password);

                                $stmt2->execute();

                            ////////////////////// CREAR CARRITO /////////////////////
                                $userId = $pdo->lastInsertId();
                                $id_carro='';
                                $insertCarrito="INSERT INTO carrito (id,id_usuario) VALUES (:id,:id_usuario)";
                                $stmtCart = $pdo->prepare($insertCarrito);
                                $stmtCart->bindParam(':id', var: $id_carro);
                                $stmtCart->bindParam(':id_usuario', var: $userId);
                                $stmtCart->execute();
                                echo "\nCarrito creado con exito";
                                header("url=../vista/login.php");


    } elseif (strpos($referer, 'admin.php') !== false) { 
            // Si la página de origen contiene 'pagina2.php', hacer otra cosa
            echo "\nAccedido desde admin.php";

            // Lógica aquí para la acción correspondiente
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $registroIdRol=$_POST["registroIdRol"];
                $numero_rol=$registroIdRol;

                //LOGICA INSERTS ADMINISTRADORES Y VENDEDORES
                                            ///////Datos Direccion
                                $id_direccion='';
                                $registroCalle=$_POST["registroCalle"];
                                $registroNumeroExterior=$_POST["registroNumeroExterior"];
                                $registroNumeroInterior=$_POST["registroNumeroInterior"];
                                $registroCodigoPostal=$_POST["registroCodigoPostal"];
                                $registroAlcaldia=$_POST["registroAlcaldia"];

                            ///////Datos Usuario
                                $id_user='';
                                $registroNombre=$_POST["registroNombre"];
                                $registroApellidoPaterno=$_POST["registroApellidoPaterno"];
                                $registroApellidoMaterno=$_POST["registroApellidoMaterno"];
                                $registroEmail=$_POST["registroEmail"];
                                $registroPass=$_POST["registroPass"];
                                $registroid_rol=$numero_rol;

                                ///////  Procesamiento de datos Direccion //////////////////////


                                //Encriptacon hash
                                $hash_password = password_hash(password: $registroPass, algo: PASSWORD_DEFAULT);

                                //Insert de la direccion
                                $crearDireccion="INSERT INTO direccion (id,calle,cp,no_ext,no_int,alcaldia) VALUES(:id_direccion, :registroCalle, :registroNumeroExterior, :registroNumeroInterior, :registroCodigoPostal, :registroAlcaldia)";

                                //preparamos consulta
                                $stmt = $pdo->prepare($crearDireccion);

                                //Valor a parameteros
                                $stmt->bindParam(':id_direccion', $id_direccion);
                                $stmt->bindParam(':registroCalle', $registroCalle);
                                $stmt->bindParam(':registroNumeroExterior', $registroNumeroExterior);
                                $stmt->bindParam(':registroNumeroInterior', $registroNumeroInterior);
                                $stmt->bindParam(':registroCodigoPostal', $registroCodigoPostal);
                                $stmt->bindParam(':registroAlcaldia', $registroAlcaldia);
                                $stmt->execute();


                            ////////////////////  Procesamiento de datos Usuario //////////////////////

                                $id_dir = $pdo->lastInsertId();

                                $crearUsuario="INSERT INTO usuarios (id,nombre,ap_pat,ap_mat,email,id_direccion,id_rol,pass) VALUES(:id_user, :registroNombre, :registroApellidoPaterno, :registroApellidoMaterno, :registroEmail, :id_dir, :registroid_rol, :registroPass)";

                                $stmt2 = $pdo->prepare($crearUsuario);

                                $stmt2->bindParam(':id_user', $id_user);
                                $stmt2->bindParam(':registroNombre', $registroNombre);
                                $stmt2->bindParam(':registroApellidoPaterno', $registroApellidoPaterno);
                                $stmt2->bindParam(':registroApellidoMaterno', $registroApellidoMaterno);
                                $stmt2->bindParam(':registroEmail', $registroEmail);
                                $stmt2->bindParam(':id_dir', $id_dir);
                                $stmt2->bindParam(':registroid_rol', $registroid_rol);
                                //cambiamos a la variable donde la encriptamos a hash en la linea: 
                                $stmt2->bindParam(':registroPass', $hash_password);

                                $stmt2->execute();
                                header("url=../vista/admin.php");
            }
    } else {
            // Si no se puede determinar desde qué página se accedió
            echo "\nAccedido desde una página desconocida";
    }
}else{
    echo "No se esta procesando nada";
}
?>