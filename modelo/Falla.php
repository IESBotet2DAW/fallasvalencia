<?php

include_once ("Modelo.php");

/* *******************************************************************************************
 
 * CLASE Caracteristica 

 
 * ***************************************************************************************** */
class Falla extends Modelo {

    private $idFalla;
    private $nombre;
    private $fechaFundacion;
    private $presupuesto;
    private $edad;

    /* *******************************************************************************************
     * CONSTRUCTOR
     * ***************************************************************************************** */

    function __construct() {
        parent::__construct();

        switch (func_num_args()) { 
            case 1: { $this->getFallaInfo(func_get_arg(0)); } // si hay un parámetro en el constructor es el id
        }
    }

    /* *******************************************************************************************
     * METODOS PRIVADOS
     * ***************************************************************************************** */	
    private function calcularEdad() {

        // se obtiene el año de nacimiento
        $fechaFundacion = new DateTime($this->fechaFundacion);

        // se instancia la fecha actual
        //$hoy = date('Y-m-d');
        $hoy = new DateTime();

        // se obtiene la diferencia entre fechas
        $diferencia = $fechaFundacion->diff($hoy);

        $edad = 0;
        // se obtiene la edad
        if ($fechaFundacion <= $hoy) {
            $edad = $diferencia->y;
        }

        $this->edad = ($edad) ? $edad : 0;

    }

    /* *******************************************************************************************
     * METODOS PUBLICOS
     * ***************************************************************************************** */	

    public function getFallaInfo($id) {

        // se inicializa el array de fallas
        $this->arrFallas = array();

        // se inicia la cadena sql para realizar la búsqueda
        $sql = " SELECT * FROM fallas WHERE id_falla = " . $id;

        // ejecución de la consulta
        $query = $this->conn->query($sql);
        $registro = $query->fetch();

        $this->setIdFalla($registro['id_falla']);
        $this->setNombre($registro['nombre']);
        $this->setFechaFundacion($registro['fecha_fundacion']);
        $this->setPresupuesto($registro['presupuesto']);
        $this->setEdad();

        // si no se ha podido cargar es que no existe
        if (!$this->idFalla) {
            throw new Exception('Falla::getFallaInfo: Falla no existe');
        }
    }

    /* Métodos getters y setters */

    public function getIdFalla() {
        return $this->idFalla;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFechaFundacion() {
        return $this->fechaFundacion;
    }

    public function getPresupuesto() {
        return $this->presupuesto;
    }	

    public function getEdad() {
        return $this->edad;	
    }

    public function setIdFalla($idFalla) {
        $this->idFalla = $idFalla;
    }	

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setFechaFundacion($fechaFundacion) {
        $this->fechaFundacion = $fechaFundacion;
    }
    
    public function setPresupuesto($presupuesto) {
        $this->presupuesto = $presupuesto;
    }

    public function setEdad() {
        $this->calcularEdad();
    }
}

?>