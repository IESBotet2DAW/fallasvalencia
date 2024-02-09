<?php
    include_once ('controlador/ControladorFalleros.php');

    // Iniciar el controlador de falleros
    $controladorFalleros = new ControladorFalleros();

    $strAccion = (isset($_POST['accion'])) ? $_POST['accion']
    : require "vista/VistaActualizarFallero.php";

    // Comprobar funcion
    switch ($strAccion) {

        case 'actualizar':
            $fallero = $controladorFalleros->actualizarFallero();
            require "vista/VistaActualizarFallero.php";
            
        break;

        default;
        break;
    }
?>