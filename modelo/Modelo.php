<?php



/* *******************************************************************************************
 
 * CLASE Caracteristica

 * ***************************************************************************************** */
class Modelo {

	// parámetros de conexión
	private $dbname = "fallas_valencia";
	private $host = "localhost"; 
		
	// creamos las credenciales del usuario
	private $usuario = "sandra";
	private $clave = "123";

	// Otros atributos
	public $conn; // conexión a la base de datos
	protected $N;
	protected $limitar = true; // si está a true se limitarán los resultados del listado a N. 



	/* *******************************************************************************************
	 * CONSTRUCTOR
	 * ***************************************************************************************** */
	function __construct() {
		$this->crearConexion();
		$this->N = 10;
	}


	/* *******************************************************************************************
	 * METODOS PRIVADOS
	 * ***************************************************************************************** */	
	private function crearConexion() {

		// Conexión a la base de datos
		$strConexion = "mysql:dbname=$this->dbname;host=$this->host";

	    // creamos un objeto de la clase PDO
	    $this->conn = new PDO($strConexion, $this->usuario, $this->clave);
	}



	/* *******************************************************************************************
	 * METODOS PRIVADOS
	 * ***************************************************************************************** */	
	public function limitar($booLimitar) {
		$this->limitar = $booLimitar;
	}

		
}

?>