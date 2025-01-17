
<?php
session_start(); // Inicia o continúa la sesión
//$_SESSION['nombre_usuario'];

?>

<nav id="nav-example" class="navbar navbar-expand navbar-light bg1-dark fixed-top">
    <div class="nav navbar-nav d-flex justify-content-center w-100">
        <!-- Enlaces centrados -->
        <a class="nav-link " href="index.php">Obsidian Rose <img src="../assets/logo.png" class="logo"></a>
        <a class="nav-link text-light" href="#div2">Productos</a>
        <a class="nav-link text-light" href="#div3">Nosotros</a>
        <a class="nav-link text-light" href="#div4">Contacto</a>
        <!-- Enlaces a la derecha -->
        <div class="ms-auto d-flex">

            <?php if (isset($_SESSION['nombre_usuario'])): ?>

                <p class="nav-link text-light">Hola <?php echo htmlspecialchars($_SESSION['nombre_usuario']);  ?>! </p>
                <p class="nav-link text-light">Id: <?php echo htmlspecialchars($_SESSION['id_usuario']);  ?> </p>
                <a class="nav-link text-light" href="../controlador/logout.php">Log out</a>
            <?php else: ?>    
                <a class="nav-link text-light" href="login.php">Log In</a>
            <?php endif; ?>
            <a class="nav-link text-light" href="carro.php">Carrito <img class="carritosvg" src="../assets/cart3.svg" alt="Carrito"></a>

        </div>
    </div>
</nav>