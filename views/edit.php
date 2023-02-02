<?php

/**
    * @version 1.0
    * @package views
*/

    $error = false;
    // 
    $config = include "config.php";

    try {

        $dsn = "mysql:host=" . $config["db"]["host"] . ";dbname=" . $config["db"]["name"];
        $conexion = new PDO($dsn, $config["db"]["user"], $config["db"]["pass"], $config["db"]["options"]);

        // Recogemos la id de la sala.
        $id = $_GET['idSala'];

        // Seleccionamos todas las salas con ese id.
        $consultaSQL = "SELECT * FROM salas where idSala='$id'";
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        $salas = $sentencia->fetch();
        
    } catch(PDOException $error) {
        $resultado["error"] = true;
        $resultado["mensaje"] = $error->getMessage();
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

<h1 style="text-align: center; margin-top: 1em;">Editar Salas</h1>

<form action="saveEdit.php" method="post" style="margin-top: 4.5em;">
  <div style="text-align: center;" class="form-row">
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
    <label for="idSala">idSala</label>
    <input type="text" name="idSala" class="form-control" id="idSala" value="<?php echo $salas["idSala"] ?>">
  </div>
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
  <input type="hidden" name="idSala" value="<?php echo $_GET["idSala"] ?>">
    <label for="capacidad">Capacidad</label>
    <input type="text" name="capacidad" class="form-control" id="capacidad" value="<?php echo $salas["capacidad"] ?>">
  </div>
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
    <label for="disponibilidad">Disponibilidad</label>
    <input type="text" name="disponibilidad" class="form-control" id="disponibilidad" value="<?php echo $salas["disponibilidad"] ?>">
  </div>
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
    <label for="horarios">Horario</label>
    <input type="text" name="horarios" class="form-control" id="horarios" value="<?php echo $salas["horarios"] ?>">
  </div>
  <div style="text-align:center; margin:1em auto;" class="form-group col-md-6">
    <label for="precio">Precio</label>
    <input type="text" name="precio" class="form-control" id="precio" value="<?php echo $salas["precio"] ?>">
  </div>
  <button style="margin-top: 1em;" type="submit" name="submit" class="btn btn-primary">Crear</button>
  <button style="margin-top: 1em;" type="submit" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="reserva.php">Salir</a></button>
</form>

<?php 
    include "../parts/footer.php";
?>