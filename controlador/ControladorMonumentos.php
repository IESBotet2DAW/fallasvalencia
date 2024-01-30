<?php 
include_once("Controlador.php");
include_once("Monumento.php");
class ControladorMonumentos extends Controlador {



    public function insertarMonumento($nombre, $lema, $presupuesto, $anyo_creacion, $idFalla){
        // $nombre = $_POST["nombre"];
        // $lema = $_POST["lema"];
        // $presupuesto = $_POST["presupuesto"];
        $anyo_creacion = new DateTime($anyo_creacion);
        // $idFalla = $_POST["idFalla"];

        $monu = new Monumento($nombre, $lema, $presupuesto, $anyo_creacion->format('Y-m-d'), $idFalla);

        $monu->insertar();

    }

}