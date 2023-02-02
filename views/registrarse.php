<?php
  if(isset($_POST["submit"])) {

    $resultado = [
        "error" => false,
        "mensaje" => "El usuario se ha creado con éxito"
    ];

    $config = include "config.php";

    try {
        $dsn = "mysql:host=" . $config["db"]["host"] . ";dbname=" . $config["db"]["name"];
        $conexion = new PDO($dsn, $config["db"]["user"], $config["db"]["pass"], $config["db"]["options"]);

        // Recogemos todos los datos del input y lo metemos en un array.
        $cliente = [
            "dni"        => $_POST["dni"],
            "nombre"     => $_POST["nombre"],
            "apellidos"  => $_POST["apellidos"],
            "email"      => $_POST["email"],
            "password"   => $_POST["password"],
            "telefono"   => $_POST["telefono"],
            "nacimiento" => $_POST["nacimiento"]
        ];

        // Comprobamos que no hay ningún campo vacío.
        if(empty($cliente["dni"]) || empty($cliente["nombre"]) || empty($cliente["apellidos"]) || empty($cliente["email"]) || empty($cliente["password"]) || empty($cliente["telefono"]) || empty($cliente["nacimiento"])){
          $resultado["mensaje"] = "<p style='color: red; text-align: center'>Error faltan datos en el formulario</p>";
        } else {
          
          // Insertamos los datos en la tabla cliente.
          $consultaSQL = "INSERT INTO cliente (dniCliente, nombre, apellidos, correo, contrasenya, telefono, fechaNacimiento)";

          $consultaSQL .= "values (:" . implode(", :" , array_keys($cliente)) . ")";

          $sentencia = $conexion -> prepare($consultaSQL);
          $sentencia -> execute($cliente);
        }
        
    } catch(PDOException $error) {
        $resultado["error"] = true;
        $resultado["mensaje"] = "Este usuario ya está creado";
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

<h1 style="text-align: center; margin-top: 0.2em;">Registro De Usuarios</h1>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" style="margin-top: 4.5em;">
  <div style="text-align: center;" class="form-row">
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
    <label for="dni">DNI</label>
    <input type="text" name="dni" class="form-control" id="dni" placeholder="DNI">
  </div>
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre">
  </div>
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos">
  </div>
    <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
    <label for="telefono">Teléfono</label>
    <input type="telephone" name="telefono" class="form-control" id="telefono" placeholder="Teléfono">
  </div>
  <div style="text-align:center; margin:1em auto;" class="form-group">
    <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
      <label for="nacimiento">Fecha de Nacimiento</label>
      <input type="date" name="nacimiento" class="form-control" id="nacimiento" placeholder="Fecha de Nacimiento">
    </div>
  </div>
  <div class="form-group">
  </div>
  <button style="margin-top: 1em;" type="submit" name="submit" class="btn btn-primary">Crear</button>
  <button style="margin-top: 1em;" type="submit" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="../index.php">Salir</a></button>
</form>

<section>
  <img style="width: 40%; margin-top: 1em" src="../img/registrar.webp" alt="">
</section>

<?php 
    include "../parts/footer.php";
?>