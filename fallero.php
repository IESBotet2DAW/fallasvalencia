<?php
require_once 'Fallero.php';
require_once 'VistaActualizarFallero.php';
require_once 'ControladorFalleros.php';

// Parámetros de conexión
$dbname = "fallas_valencia";
$host = "localhost";

// Crear la cadena de conexión
$strConexion = "mysql:dbname=$dbname;host=$host";

// Crear las credenciales del usuario
$usuario = "david3";
$clave = "david123";

try {
    $bd = new PDO($strConexion, $usuario, $clave);
} catch (PDOException $e) {
    echo "Error con la base de datos: " . $e->getMessage();
}

$modelo = new Fallero($bd);
$vista = new VistaActualizarFallero();
$controlador = new ControladorFalleros($modelo, $vista);

// Procesar el formulario y actualizar datos
$controlador->procesarFormulario();
$controlador->actualizarDatos();

?>