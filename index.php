<?php

/**
    * @author Alejandro Domínguez Carreño
    * @version 1.0
    * @package General
    * @Date: 2023-02-02
    * @email: alejandrodominguezc7@gmail.com
    * @Github: https://github.com/AlejandroDominguez
 */ 

    // Iniciamos la session, para trabajar con ella.
    session_start();
    
    // Al entrar en la página sin hacer login, entramos con la sesión 0 para mostrar las páginas de acuerdo a nuestro nivel.
    if(empty($_SESSION["usuario"])) {
        $_SESSION["usuario"] = 0;
    }
?>

<?php 
    include "parts/header.php";
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Reserva Salas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="./views/login.php">Login</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./views/reserva.php">Reservar</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./views/mostrarReserva.php">Mostrar reserva</a>
            </li>
        </ul>
        </div>
        
    </div>
    </nav>

    <section style="width: 100%; margin-top: 1em; text-align:center;">
        <img style="width: 90%; height: 600px;" src="./img/portada.jpg" alt="">
    </section>

    <article style="display: flex; margin: 2em;">
        <img style=" border: outset gray" src="./img/biblio.jpg" alt="">

        <section style="text-align: center; margin: 1em 1.5em;">
            <p>La Biblioteca Insular de Gran Canaria pone a su disposición salas y espacios para realización de eventos de todo tipo: presentaciones de libros, seminarios, talleres, etc. 
            </p>
            <p style="margin: 2em 0;">Algunos de estos eventos serán difundidos en redes sociales como colaboración con el acto.
            </p>
            <p>Las reservas se realizarán mediante solicitud con una antelación de 30 días a la realización de la actividad.
            </p>
        </section>
    </article>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php 
    include "parts/footer.php";
?>