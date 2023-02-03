<?php

/**
    * @version 1.0
    * @package views
*/

    // Configuramos nuestro enlace a la bd.
    return [
        'db' => [
            'host' => $_ENV['DB_HOST'],
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASS'],
            'name' => $_ENV['DB_DB'],
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ]
    ];
?>



<!-- return [
    'db' => [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'name' => 'gestionSalas',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
]; -->
