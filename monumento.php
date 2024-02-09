<?php 

	// establecer la caducidad de la caché a 0 minutos para poder trabajar con variables de sesión
	session_cache_expire(0);
	
	// se inicializa la sesión de usuario
	session_start();
	
	// se pone en marcha el control de errores
	try {
		include_once __DIR__ . "/controlador/ControladorMonumentos.php";
		$cm = new ControladorMonumentos();

		if(isset($_GET['idm'])) {
			$idm=$_GET['idm'];
			$monumentoArray = $cm->mostrarTablaMonumento($idm);
		} 
		elseif (!isset($_POST['listaMonumento'])) {
			$arraymonumentos = $cm->mostrarListaMonumentos();
		} else {
			$monumentoArray = $cm->mostrarTablaMonumento($_POST['listaMonumento']);
		}
		require __DIR__ . '/vista/VistaMostrarMonumento.php';
	// se capturan el resto de excepciones		
	} catch (Exception $e) {

		// se redirecciona a la página de inicio
		header("Location: /fallasvalencia/");
	}	
?>