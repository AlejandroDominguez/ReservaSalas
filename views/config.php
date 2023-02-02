<?php
    // Configuramos nuestro enlace a la bd.
    return [
        'db' => [
            'host' => 'localhost',
            'user' => 'root',
            'pass' => '',
            'name' => 'gestionSalas',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ]
    ];
?>