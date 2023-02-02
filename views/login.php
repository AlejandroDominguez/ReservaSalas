<?php
    // Comprabmos que se le de al botón iniciar.
    if(isset($_POST["enviar"])) {

        session_start();

        $config = include 'config.php';

        try{
            
            // Conexión con la base de datos.
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
            $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

            // Recogemos los datos de los imputs.
            $email = $_POST["email"];
            $password = $_POST["password"];

            // $consultaSQL para recoger el correo del cliente;
            $consultaSQL = $conexion->prepare("SELECT * FROM cliente where correo=:correo");

            // Usamos bindParam, para que cambie el valor antes del execute y usamos el PARAM_STR para indicar que es tipo varchar.
            $consultaSQL->bindParam("correo", $email, PDO::PARAM_STR);

            $consultaSQL->execute();
        
            // $consultaSQL para recoger el correo del administrador;
            $consultaSQL2 = $conexion->prepare("SELECT * FROM administrador where correo=:correo");
            
            $consultaSQL2->bindParam("correo", $email, PDO::PARAM_STR);

            $consultaSQL2->execute();
            // FETCH_ASSOC nos devuelve el array indexado por nombre de la columna tal y como nos lo devuelve la consulta.
            $cliente = $consultaSQL->fetch(PDO::FETCH_ASSOC);
            $administrador = $consultaSQL2->fetch(PDO::FETCH_ASSOC);

            // Comprobación correo y contraseña que no estén vacíos y estén correctos.
            if(!empty($email) || !empty($password)){
                // Comprobamos que los datos existen del correo.
                if(isset($cliente["correo"])){
                    // Comprobamos que las contraseñas son iguales.
                    if($password == $cliente["contrasenya"]){
                        $_SESSION["usuario"] = 2;
                        header('Location: ../index.php');
                    } else {
                        echo "<p> Contraseña Incorrecta </p>";
                    } 

                } elseif(isset($administrador["correo"])) {
                    if($password == $administrador["password"]){
                        $_SESSION["usuario"] = 1;
                        header('Location: ../index.php');
                    } else {
                        echo "<p> Contraseña Incorrecta </p>";
                    } 
                } else {
                    echo "<p> Correo Incorrecto </p>";
                }
            } else {
                echo "<p> Faltan datos formularios </p>";
            }
                
        } catch(PDOException $error){
            $resultado["error"] = true;
            $resultado["mensaje"] = $error -> getMessage();
        }
    }
?>

<?php 
    include "../parts/header.php";

    if(isset($resultado)) {
        ?>
        
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert- <?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
                        <?= $resultado["mensaje"] ?>
                    </div>
                </div>
            </div>
        </div>
    
<?php
    }
?>

<link rel="stylesheet" href="../css/login.css">

<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                            <h3 class="text-center">Login</h3>
                            <div class="form-group">
                                <label for="username">Correo:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div style="margin-top: 0.5em;" class="form-group">
                                <span><a style="color: black;" href="./registrarse.php">Registrate Aqui!</a></span><br>
                                <button name="enviar" style="margin-top: 1em;" type="submit" class="btn btn-info btn-md">Iniciar</button>
                                <button style="margin-top: 1em;" type="submit" class="btn btn-info btn-md"><a style="color: black; text-decoration: none;" href="../index.php">Volver</a></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
    include "../parts/footer.php";
?>