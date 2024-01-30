<?php
class ControlMonumentos extends Controlador {

    function __construct() {
		parent::__construct();
	}
//FUNCIONES DE LOS MONUMENTOS
public function mostrarMonumento() {

    // se recogen los parámetros de entrada
    $id_monumento = $_POST['id'];
    
    $sql3 = "SELECT * FROM monumento WHERE id_monumento=?";
    $consultaFalla = $sbd->prepare($sql3);
    $consultaFalla->execute([$id_monumento]);

    $monumento = new Monumento($id_monumento );

    // se inserta el personaje
    $monumento->mostrarMonumento();
}	
}
?>