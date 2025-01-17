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

    </head>

    <body>

        <header>
            <!-- place navbar here -->
             
            <nav id="nav-example" class="navbar navbar-expand navbar-light bg1-dark fixed-top">
                <div class="nav navbar-nav d-flex justify-content-center w-100">
                    <!-- Enlaces centrados -->
                    <a class="nav-link " href="#div1">LogIn</a>
                    <a class="nav-link text-light" href="#div2">Registrate</a>
                    <!-- Enlaces a la derecha -->
                    <div class="ms-auto d-flex">
                        <a class="nav-link text-light" href="index.php">Regresar</a>
                        <a class="nav-link text-light" href="#div3">Soporte</a>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <!-- Log in-->
            <div id="div1" class="bg-primary" style="height: 100vh"> 
                <br>
                <h1>Inicio de Sesion</h1>
                <form class="formLogIn" action="../controlador/controladorLogin.php" method="post" id="form_login">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="emailLogin" >
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="passLogin" >
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Submit</button>
                </form>
                <br>
                <a><button   onclick='usuario()'>Usuario</button></a>
                <a><button   onclick='Vendedor()'>Vendedor</button></a>
                <a><button   onclick='Admin()'>Admin</button></a>
            <script>
                    function usuario(){
                        
                        var formulario = document.getElementById('form_login'); //llamas por ID
                        formulario.elements['exampleInputEmail1'].value = 'gwen@gmail.com';
                        formulario.elements['exampleInputPassword1'].value = '12345';
                    }
                    function Vendedor(){
                        
                        var formulario = document.getElementById('form_login'); //llamas por ID
                        formulario.elements['exampleInputEmail1'].value = 'sera@gmail.com';
                        formulario.elements['exampleInputPassword1'].value = '12345';
                    }
                    function Admin(){
                        var formulario = document.getElementById('form_login'); //llamas por ID
                        formulario.elements['exampleInputEmail1'].value = 'admin@gmail.com';
                        formulario.elements['exampleInputPassword1'].value = 'admin';
                    }
            </script>
            </div>
            
<!-- ///////////////////////  Registro /////////////////////////////////////////////////////////-->

            <div id="div2" class="bg-success" style="height: 100vh"> 
                <br>
                <h1>Registrate</h1>
                <form class="formLogIn" action="../controlador/controladorLogin.php" method="post">
                    <table>
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
                    </table>
                    <button type="submit" class="btn btn-primary" name="registro">Submit</button>
                </form>
            </div>
            
            <div id="div3" class="bg-primary" style="height: 100vh">         
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
