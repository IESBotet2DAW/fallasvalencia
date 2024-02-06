<?php

include_once __DIR__ . '/Controlador.php';
include_once __DIR__ . '/../modelo/Monumento.php';

class ControladorMonumentos extends Controlador {

    function __construct() {
		parent::__construct();
	}
//FUNCIONES DE LOS MONUMENTOS
public function mostrarListaMonumentos() {
    $monumento = new Monumento();
    $arraymonumentos = $monumento->listaMonumentos();
    return $arraymonumentos;
}	

public function mostrarTablaMonumento() {
    $idMonumento=$_POST["listaMonumento"];
    $monumento = new Monumento();
    $arrayTablaMonumento = $monumento->tablaMonumentos($idMonumento);
    return $arrayTablaMonumento;
}	
}
?>