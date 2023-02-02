<?php
// Creamos una función para .......
    function codificarHTML($html){
        return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    }
?>