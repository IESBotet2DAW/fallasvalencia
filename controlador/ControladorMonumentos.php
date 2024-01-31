<?php
class ControladorMonumentos extends Controlador {

    function __construct() {
		parent::__construct();
	}
//FUNCIONES DE LOS MONUMENTOS
public function mostrarMonumento() {

    $id_monumento = $_POST['monumento'];

    $monumento = new Monumento();
    

    // se inserta el personaje
    $arraymonumentos=$monumento->listaMonumento();


    require '/vista/VistaMostrarMonumento.php';
}	
}
?>