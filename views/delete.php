<?php

/**
    * @version 1.0
    * @package views
*/

  session_start();

  $error = false;
  // Incluimos la configuración para acceder.
  $config = include 'config.php';

  try{
  
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    // Recogemos la id de la sala.
    $id = $_GET["idSala"];

    // Consulta que sirve para borrar la sala por su id;
    $consultaSQL = "DELETE FROM salas where idSala='$id'";
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();

    $salas = $sentencia->fetchAll();

    // Redireccionamos a la página de reserva.
    header("Location: reserva.php");

} catch(PDOException $error){
    $error = $error->getMessage();
}
?>


