<?php
  // Comprobamos si hemos pulsado el botón.
  if(isset($_POST["submit"])) {

    $resultado = [
        "error" => false,
        "mensaje" => "Sala creada"
    ];

    // Incluimos la configuración de la bd para acceder.
    $config = include "config.php";

    try {
        // Accedemos a la bd.
        $dsn = "mysql:host=" . $config["db"]["host"] . ";dbname=" . $config["db"]["name"];
        $conexion = new PDO($dsn, $config["db"]["user"], $config["db"]["pass"], $config["db"]["options"]);

        // Creamos un array donde recogemos los datos de los inputs.
        $salas = [
            "capacidad"    => $_POST["capacidad"],
            "horario"     => $_POST["horario"],
            "precio"  => $_POST["precio"]
        ];

        // Comprobamos si los campos están vacíos, si lo están salta error, si no, se hace la consulta.
        if(empty($salas["capacidad"]) || empty($salas["horario"]) || empty($salas["precio"])){
          $resultado["mensaje"] = "<p style='color: red; text-align: center'>Error faltan datos en el formulario</p>";
        } else {
          
          // Hacemos una consulta para insertar datos.
          $consultaSQL = "INSERT INTO salas (capacidad, horarios, precio)";

          // Le decimos los datos que queremos mostrar.
          $consultaSQL .= "values (:" . implode(", :" , array_keys($salas)) . ")";

          $sentencia = $conexion -> prepare($consultaSQL);
          $sentencia -> execute($salas);
        }
        
    } catch(PDOException $error) {
        $resultado["error"] = true;
        $resultado["mensaje"] = $error->getMessage();
    }
  }
?>

<?php 
    // Incluimos el archivo header para empezar la página.
    include "../parts/header.php";
    
    // Comprobamos que le hemos dado al botón.
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

<h1 style="text-align: center;">Creación de salas</h1>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" style="margin-top: 4.5em;">
  <div style="text-align: center;" class="form-row">
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
    <label for="Capacidad">Capacidad</label>
    <input type="text" name="capacidad" class="form-control" id="capacidad" placeholder="Capacidad">
  </div>
    <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
      <label for="Horario">Horario</label>
      <input type="text" name="horario" class="form-control" id="horario" placeholder="Ej. 10:00 - 11:00">
    </div>
    <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
      <label for="Precio">Precio</label>
      <input type="Precio" name="precio" class="form-control" id="precio" placeholder="Precio">
    </div>
  </div>
  <div class="form-group">
  </div>

  <button style="margin-top: 1em;" type="submit" name="submit" class="btn btn-primary">Crear</button>
  <button href="./reserva.php" style="margin-top: 1em;" type="submit" class="btn btn-secondary"><a style="color: white; text-decoration: none; width: 100%" href="./reserva.php">Salir</button></a>
</form>


<?php 
    // Incluimos el archivo footer para cerrar la página.
    include "../parts/footer.php";
?>