<?php

/**
    * @version 1.0
    * @package views
*/

  session_start();

  include 'functions.php';
  $error = false;
  $config = include 'config.php';

  try{
    // Iniciamos la base de datos.
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    // Hacemos una consulta que nos recoja todas las salas de la bd.
    $consultaSQL = "SELECT * FROM salas";
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();

    // Toda la información la tenemos en la variable salas.
    $salas = $sentencia->fetchAll();


} catch(PDOException $error){
    $error = $error->getMessage();
}
?>

<?php
    // Incluimos el header para no repetir todo el html.
    include  "../parts/header.php";

    // Hacemos un if para comprobar que es el administrador y solo vea este cacho de página.
    if($_SESSION["usuario"] == 1){
?>

<table style="margin-top: 5em" class="table table-hover">
<h1 style="text-align: center; margin-top: 0.5em">Salas</h1>
  <thead>
    <tr>
      <th scope="col">Capacidad</th>
      <th scope="col">disponibilidad</th>
      <th scope="col">Horario</th>
      <th scope="col">Precio</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
          // Comprobamos que es mayor que 0.
          if($salas && $sentencia->rowCount()>0){
              // Recogemos los datos de salas y lo metemos en fila.
              foreach($salas as $fila){
      ?>
      
      <tr>
          <td><?php echo codificarHTML($fila["capacidad"]); ?></td>
          <td><?php echo codificarHTML($fila["disponibilidad"]); ?></td>
          <td><?php echo codificarHTML($fila["horarios"]); ?></td>
          <td><?php echo codificarHTML($fila["precio"]); ?></td>
          <td><a href="<?php echo 'edit.php?idSala='.$fila['idSala'] ?>" class="btn btn-primary mt-4">Editar</a></td>
          <td><a href="<?php echo 'delete.php?idSala='.$fila['idSala'] ?>" class="btn btn-primary mt-4">Borrar</a></td>
      </tr>

    <?php
          }
      }
    ?>
  </tbody>
</table>

<button style="margin: 1em;" type="submit" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="../index.php">Salir</a></button>
<button style="margin: 1em;" type="submit" name="submit" class="btn btn-primary"><a style="color: white; text-decoration: none;" href="creacionSala.php">Crear</a></button>


<?php
  // Comprobamos que es un usuario logeado.
  } elseif($_SESSION["usuario"] == 2) {
    
?>

<table style="margin-top: 5em" class="table table-hover">
<h1 style="text-align: center; margin-top: 0.5em">Salas</h1>
  <thead>
    <tr>
      <th scope="col">Capacidad</th>
      <th scope="col">disponibilidad</th>
      <th scope="col">Horario</th>
      <th scope="col">Precio</th>
      <th></th>
      
    </tr>
  </thead>
  <tbody>
    <?php
          if($salas && $sentencia->rowCount()>0){
            foreach($salas as $fila){
      ?>
      
      <tr>
          <td><?php echo codificarHTML($fila["capacidad"]); ?></td>
          <td><?php echo codificarHTML($fila["disponibilidad"]); ?></td>
          <td><?php echo codificarHTML($fila["horarios"]); ?></td>
          <td><?php echo codificarHTML($fila["precio"]); ?></td>
          <td><a href="" class="btn btn-primary mt-4">Reservar</a></td>
      </tr>

    <?php
          }
      }
    ?>
  </tbody>
</table>

<button style="margin-top: 1em;" type="submit" class="btn btn-text btn-md"><a style="color: black; text-decoration: none;" href="../index.php">Volver</a></button>

<?php
  // Comprobamos que no se ha logeado el usuario.
  } elseif($_SESSION["usuario"] == 0) {
?>

<h1>Tienes que iniciar sesión primero</h1>
<button style="margin-top: 1em;" type="submit" class="btn btn-text btn-md"><a style="color: black; text-decoration: none;" href="../index.php">Volver</a></button>

<?php
  }
?>


<?php 
  // Incluimos el footer para no repetir todo el html.
  include  "../parts/footer.php"
?>