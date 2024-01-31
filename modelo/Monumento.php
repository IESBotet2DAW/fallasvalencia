<?php

include_once 'Modelo.php';

class Monumeto extends Modelo{

    private $id_monumento;
    private $nombre;
    private $lema;
    private $presupuesto;
    private $anyo_creacion;
    private $id_falla;

    function __construct() {
        parent::__construct();
        $this->id_monumento;
        $this->nombre;
        $this->lema;
        $this->presupuesto;
        $this->anyo_creacion;
        $this->id_falla;
    }

    public function getId_monumento() {
        return $this->id_monumento;
    }

    public function setId_monumento($id_monumento) {
        $this->id_monumento = $id_monumento;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getLema() {
        return $this->lema;
    }

    public function setLema($lema) {
        $this->lema = $lema;
    }

    public function getPresupuesto() {
        return $this->presupuesto;
    }

    public function setPresupuesto($presupuesto) {
        $this->presupuesto = $presupuesto;
    }

    public function getAnyo_creacion() {
        return $this->anyo_creacion;
    }

    public function setAnyo_creacion($anyo_creacion) {
        $this->anyo_creacion = $anyo_creacion;
    }

    public function getId_falla() {
        return $this->id_falla;
    }

    public function setId_falla($id_falla) {
        $this->id_falla = $id_falla;
    }

    public function listaMonumento(){
        $sbd=$this->conn;
    
        $sql1 = "SELECT id_monumento, nombre FROM monumentos";
        $consulta = $sbd->query($sql1);
        while($registro = $consulta->fetch()){ 
            $id_monumento=$registro['id_monumento'];
            $nombre=$registro['nombre'];
        }
        return[$id_monumento,$nombre];
    }
}
?>