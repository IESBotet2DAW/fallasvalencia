<?php 
include_once("controlador/Controlador.php");
include_once("modelo/Monumento.php");
class ControladorMonumentos extends Controlador {



    public function insertarMonumento(){
        $nombre = $_POST["nombre"];
        $lema = $_POST["lema"];
        $presupuesto = $_POST["presupuesto"];
        $anyo_creacion = new DateTime($_POST["anyo_creacion"]);
        $idFalla = $_POST["idFalla"];

        $monu = new Monumento($nombre, $lema, $presupuesto, $anyo_creacion->format('Y'), $idFalla);

        $monu->insertar();
       

    }

    public function mostrarFallas(){

        $obj = new Monumento(null, null, null, null, null);
        $arrFallas = $obj->mostrarFallas();
        require "vista/VistaInsertarMonumento.php";
    }

}