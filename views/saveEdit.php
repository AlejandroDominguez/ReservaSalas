<?php

/**
    * @version 1.0
    * @package views
*/

    $error = false;
    $config = include "config.php";

    $dsn = "mysql:host=" . $config["db"]["host"] . ";dbname=" . $config["db"]["name"];
    $conexion = new PDO($dsn, $config["db"]["user"], $config["db"]["pass"], $config["db"]["options"]);

    // Recogemos los datos de los inputs.
    $idSala = $_POST["idSala"];
    $capacidad = $_POST["capacidad"];
    $disponibilidad = $_POST["disponibilidad"];
    $horarios = $_POST["horarios"];
    $precio = $_POST["precio"];
    
    // Actualizamos los datos.
    $consultaSQL = $conexion->prepare("UPDATE salas SET idSala = ?, capacidad = ?, disponibilidad = ?, horarios = ?, precio = ? where idSala = ?;");

    $sentencia = $consultaSQL->execute([$idSala, $capacidad, $disponibilidad, $horarios, $precio, $idSala]);

    header("Location: ./reserva.php")

?>

