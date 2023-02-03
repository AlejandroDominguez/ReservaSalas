<?php

/**
    * @version 1.0
    * @package views
*/

    $config = include 'config.php';
    
    try{
        // Hacemos la conexión y ejecutamos la base de datos para crearla.
        $conexion = new PDO('mysql:host=' . $config['db']['host'],$config['db']['user'],$config['db']['pass'],$config['db']['options']);
        $sql = file_get_contents("../data/bbdd.sql");
        $conexion->exec($sql);
        echo "La base de datos y las tablas se han creado con éxito";
    } catch(PDOException $error){
        echo $error->getMessage();
    }
?>