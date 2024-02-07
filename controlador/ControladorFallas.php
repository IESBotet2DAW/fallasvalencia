<?php 
include_once ("modelo/Buscador.php");
include_once ("Controlador.php");

/* Lógica de los métodos de clases relativas al modelo:
a) Recoger información del modelo.
b) Trabajar o manipular la información.
c) Preparar la información para ser presentada a la vista.
d) Realizar la llamada a la vista.*/

/* *******************************************************************************************
 
 * CLASE Controlador

 * ***************************************************************************************** */

class ControladorFallas extends Controlador {
    
    /* *******************************************************************************************
    * CONSTRUCTOR
    * ***************************************************************************************** */

    function __construct() {
            parent::__construct();
    }
    
    /* *******************************************************************************************
    * METODOS PRIVADOS
    * ***************************************************************************************** */	

    private function crearJsonFallas($arrFallas, $numRegistros) {

        // se recorre todo el array de fallas
        foreach ($arrFallas as $falla) {

            // se crea la siguiente falla
            $arrJson[] = array(
                "id_falla" => $falla->getIdFalla(),
                "nombre" => $falla->getNombre(),
                "fechaFundacion" => $falla->getFechaFundacion(),
                "presupuesto" => $falla->getPresupuesto(),
                "edad" => $falla->getEdad()
            );
        }

        // se incluye el número de registros y las fallas en el json
        $arrJs = array($numRegistros, $arrJson);

        // se codifica el array en formato JSON
        $json = json_encode($arrJs);

        // se devuelve el json
        return $json;
    }

    /* *******************************************************************************************
    * METODOS PUBLICOS
    * ***************************************************************************************** */	

    public function cargarFallas() {

        // se carga el buscador
        $buscador = new Buscador();

        // se obtiene el total de personajes que hay
        $numRegistros = $buscador->numRegistros('fallas');

        // se buscan las fallas
        $arrFallas = $buscador->buscarFallas();
        
        // se codifica el array de fallas en un JSON
        $jsonFallas = $this->crearJsonFallas($arrFallas, $numRegistros);

        // se devuelve el json de fallas
        echo $jsonFallas;

    }
    
    public function cargarFalla() {

        $idFalla = $_POST['idFalla'];
        
        // se instancia la falla
	    $f = new Falla();
                
        // se buscan la falla
        $f->getFallaInfo($idFalla); 
        
        $arrFallas[0] = $f;
        
        $jsonFallas = $this->crearJsonFallas($arrFallas, 1);
        
        // se abre la vista de las fallas
        echo $jsonFallas;

    }
}?>