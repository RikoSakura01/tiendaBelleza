<?php

$host="localhost";
$user="root";
$pass="";
$dbname="belleza_cuidado";

//echo ("base de datos conectada");
try {

    // Crear instancia del objeto PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);


    // Establecer el modo de error para PDO (para mostrar excepciones)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Conexión PDO exitosa!";
} catch (PDOException $e) {
    // Manejo de excepciones
    echo "Error de conexión: " . $e->getMessage();
}

?>