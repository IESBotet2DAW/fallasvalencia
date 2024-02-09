<?php

include_once 'Modelo.php';

class Monumento extends Modelo{

    private $id_monumento;
    private $nombre;
    private $lema;
    private $presupuesto;
    private $anyo_creacion;
    private $id_falla;

    function __construct() {
        parent::__construct();
    }
    public function listaMonumentos() {
    
        $sql1 = "SELECT id_monumento, nombre FROM monumentos";
        $consulta = $this->conn->query($sql1);
        $arrayMonumentos = array();
    
        while ($registro = $consulta->fetch()) {
    
            $arrayMonumentos[] = array('id_monumento' => $registro['id_monumento'], 'nombre' => $registro['nombre']);
        }
    
        return $arrayMonumentos;
    }
    public function tablaMonumentos($idMonumento) {
    
        $sql2 = "SELECT * FROM monumentos WHERE id_monumento=?";
        $consultaFalla = $this->conn->prepare($sql2);
        $consultaFalla->execute([$idMonumento]);

        while($registro = $consultaFalla->fetch()){
            $this->id_monumento=$registro['id_monumento'];
            $this->nombre=$registro['nombre'];
            $this->lema=$registro['lema'];
            $this->presupuesto=$registro['presupuesto'];
            $this->anyo_creacion=$registro['anyo_creacion'];
            $this->id_falla=$registro['id_falla'];
        }
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
        return $this->presupuesto=number_format($this->presupuesto,2,',','.');
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
}
?>