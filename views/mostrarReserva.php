<?php

  $error = false;
  $config = include 'config.php';

  try{
      $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
      $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

      // Hacemos la consulta que muestra todos los datos de salas.
      $consultaSQL = "SELECT * FROM salas";
      $sentencia = $conexion->prepare($consultaSQL);
      $sentencia->execute();

      $salas = $sentencia->fetchAll();

  } catch(PDOException $error){
      $error = $error->getMessage();
  }
?>

<?php
    include "../parts/header.php";
?>

<link rel="stylesheet" href="../css/style.css">

<section class="intro">
  <div style="background-color: gray;" class="bg-image h-100" style="background-color: #f5f7fa;">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card-body p-0">
            <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                <table class="table table-dark mb-0">
                <thead style="background-color: #393939;">
                    <tr class="text-uppercase text-success">
                    <th scope="col">id Sala</th>
                    <th scope="col">Type</th>
                    <th scope="col">Hours</th>
                    <th scope="col">Trainer</th>
                    <th scope="col">Spots</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Mind &amp; Body</td>
                    <td>Yoga</td>
                    <td>8:00 AM - 9:00 AM</td>
                    <td>Adam Stewart</td>
                    <td>15</td>
                    </tr>
                    
                    
                </tbody>
                </table>
            </div>
            <button style="margin-top: 1em;" type="submit" class="btn btn-info btn-md">Iniciar</button>
            <button style="margin-top: 1em;" type="submit" class="btn btn-info btn-md"><a style="color: black; text-decoration: none;" href="../index.php">Volver</a></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
    include "../parts/footer.php";
?>