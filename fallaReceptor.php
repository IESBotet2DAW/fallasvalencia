<?php 

	// establecer la caducidad de la caché a 0 minutos para poder trabajar con variables de sesión
	session_cache_expire(0);
	
	// se inicializa la sesión de usuario
	session_start();
	
	// se pone en marcha el control de errores
	try {

	

	// se incluye el controlador de personajes
	include_once ("controlador/ControladorFallas.php");

	// se incluye el control de excepciones de permisos
	include_once ("controlador/PermisosException.php");

	$arrPermisos = ['admin', 'escritor'];

	// se inicializa el controlador de fallas
	$cf = new ControladorFallas();

	// si el usuario no tiene un rol con acceso se lanza el error
	if (!$cf->getAcceso($_SESSION['rol'], $arrPermisos)) throw new PermisosException(2, '[2] Acceso denegado');

	// se recoge la acción pasada por el usuario
	$strAccion = (isset($_POST['accion'])) ? $_POST['accion'] : 'cargarFallas';
	// dependiendo de la acción de usuario se solicita una acción u otra al controlador
	switch ($strAccion) {
            
            // se ha solicitado la acción buscarPersonajes
            case 'cargarFalla':
                $cf->cargarFalla();
                break;

            // si no hay acción se elige la acción por defecto que es obtener la lista de fallas
            default:
                // se solicita abrir la ventana de fallas
                $cf->cargarFallas();
                break;
	}

	// se captura primero las excepciones por permiso denegado
	} catch (PermisosException $e) {

            // en caso de permiso denegado se solicita al controlador preparar la vista de usuario
            $arrTiempoConexion = $cf->prepararUsuario();

            // guardamos el error de usuario
            $strPermisoDenegado = $e->getMessage();

            // se despliega la vista de usuario
            require 'vista/VistaUsuario.php';

	// se capturan el resto de excepciones		
	} catch (Exception $e) {

            // se redirecciona a la página de inicio
            header("Location: /fallasvalencia/");
	}	
	
?>