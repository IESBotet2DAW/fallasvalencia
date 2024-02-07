<?php

include_once ("Modelo.php");
include_once ("Falla.php");



/* *******************************************************************************************
 * CLASE Buscador
 * ***************************************************************************************** */

class Buscador extends Modelo  {

	private $arrFallas;

	/* *******************************************************************************************
	 * CONSTRUCTOR
	 * ***************************************************************************************** */

	function __construct() {
            parent::__construct();
	}

	/* *******************************************************************************************
	 * METODOS PUBLICOS
	 * ***************************************************************************************** */	

	public function numRegistros($tabla, $arrId = null) {

            // cadena sql para realizar la búsqueda de todos los registros que cumplan la condición
            $sql = ($arrId) ? 
                    "select count(".$arrId[0].") from ".$tabla." where ".$arrId[0]." = ".$arrId[1] : 
                    "select count(*) from ".$tabla;
            
            // ejecución de la consulta
            $query = $this->conn->query($sql);

            // obteniendo el primer registro de la base de datos
            $arrRegistro = $query->fetch();

            // se devuelve la cantidad de registros encontrados
            return $arrRegistro[0];

	}	

	public function buscarFallas() {

            // se inicializa el array de fallas
            $this->arrFallas = array();

            // se inicia la cadena sql para realizar la búsqueda
            $sql = " SELECT id_falla, nombre, fecha_fundacion, presupuesto FROM fallas";

            // aplicamos la ordenación
            $sql .= " order by nombre asc ";

            // ejecución de la consulta
            $query = $this->conn->query($sql);

            // recorriendo el apuntador para obtener todos los registros
            while($registro = $query->fetch()) {
                    // creando la falla
                    $falla = new Falla();
                    $falla->setIdFalla($registro['id_falla']);
                    $falla->setNombre($registro['nombre']);
                    $falla->setFechaFundacion($registro['fecha_fundacion']);
                    $falla->setPresupuesto($registro['presupuesto']);
                    $falla->setEdad();
                    // introduciendo la falla en el array de fallas
                    $this->arrFallas[] = $falla;
            }
            return $this->arrFallas;
	}
        
        public function buscarFalla($idFalla) {

            // se inicializa el array de fallas
            $this->arrFallas = array();

            // se inicia la cadena sql para realizar la búsqueda
            $sql = " SELECT * FROM fallas WHERE id_falla = " . $idFalla;

            // ejecución de la consulta
            $query = $this->conn->query($sql);
            $registro = $query->fetch();
            
            $falla = new Falla();
            $falla->setIdFalla($registro['idFalla']);
            $falla->setNombre($registro['nombre']);
            $falla->setFechaFundacion($registro['fecha_fundacion']);
            $falla->setPresupuesto($registro['presupuesto']);
            $falla->setEdad();
            
            return $falla;
	}
	
	/* Métodos getters y setters */
	public function getFallas() {
		return $this->arrFallas;
	}

	public function setFallas($arrFallas) {
		$this->arrFallas = $arrFallas;
	}
}

?>