<?php

include_once ('./modelo/Fallero.php');

/* ************************************************************************************ *
 * CLASE Controlador
 * ************************************************************************************ */

class ControladorFalleros {

	/* ************************************************************************************ *
	 * CONSTRUCTOR
	 * ************************************************************************************ */
	function __construct() {}

	/* *******************************************************************************************
	 * METODOS PUBLICOS
	 * ***************************************************************************************** */	
	
     public function actualizarFallero() {

        // Verificar si se envió el DNI del fallero
        if (isset($_POST['dni'])) {

            // Crear instancia de la clase Fallero
            $fallero = new Fallero();
            
            // Asignar valores
            $fallero->setDni($_POST['dni']);

            if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
                $fallero->setNombre($_POST['nombre']);
            }

            if (isset($_POST['apellidos']) && !empty($_POST['apellidos'])) {
                $fallero->setApellidos($_POST['apellidos']);
            }

            if (isset($_POST['cuota']) && !empty($_POST['cuota'])) {
                $fallero->setCuota($_POST['cuota']);
            }

            if (isset($_POST['id_falla']) && !empty($_POST['id_falla'])) {
                $fallero->setIdFalla($_POST['id_falla']);
            }
            
            // Actualizar el fallero
            $fallero->actualizar();

            return $fallero;
        }
        
    }
}

?>