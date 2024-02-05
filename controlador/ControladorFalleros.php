<?php

/* ************************************************************************************ *
 * CLASE Controlador
 * ************************************************************************************ */

class ControladorFalleros {

	private $modelo;
    private $vista;

	/* ************************************************************************************ *
	 * CONSTRUCTOR
	 * ************************************************************************************ */
	function __construct($modelo, $vista) {
        $this->modelo = $modelo;
        $this->vista = $vista;
    }	

	/* *******************************************************************************************
	 * METODOS PUBLICOS
	 * ***************************************************************************************** */	
	
	public function procesarFormulario() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dni = $_POST['dni'];
            $falleroInfo = $this->modelo->obtenerFallero($dni);
            $this->vista->mostrarFormulario($dni, $falleroInfo);
        }
    }

    public function actualizarDatos() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $cuota = $_POST['cuota'];
            $id_falla = $_POST['id_falla'];

            $registrosActualizados = $this->modelo->actualizarFallero($dni, $nombre, $apellidos, $cuota, $id_falla);

            echo "Actualización de datos del fallero correcta<br>";
            echo "Cantidad de registros actualizados: " . $registrosActualizados . "<br><br>";
        }
    }

}

?>