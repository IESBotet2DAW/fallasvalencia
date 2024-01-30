<!-- ------------------------------------------------------------------------------------------
VistaActualizarFallero
------------------------------------------------------------------------------------------- -->

<!doctype html>
<html lang="en">

<!-- Cabecera de la aplicación -->
<?php require 'base/cabecera.php' ?>


<!-- ------------------------------------------------------------------------------------------
CUERPO DE LA VISTA
------------------------------------------------------------------------------------------- -->

<body>
  <div class="areaTrabajo"> 

  <!-- se indica el título de la página -->
  <div class="tituloPagina">
    <h1>Actualizar Fallero</h1>
  </div>

  <?php $vistaActiva = 'VistaUsuario'; ?>

    <!-- menú principal de la aplicación -->
    <?php require 'base/menu.php' ?>

  <div>
    
<?php
// Parámetros de conexión
$dbname = "fallas_valencia";
$host = "localhost"; // también se se podría poner 127.0.0.1

// Crear la cadena de conexión
$strConexion = "mysql:dbname=$dbname;host=$host";

// Crear las credenciales del usuario
$usuario = "david3";
$clave = "david123";

try {
    // Crear un objeto de la clase PDO
    $bd = new PDO($strConexion, $usuario, $clave);
?>

    <form action="VistaActualizarFallero.php" method="POST">
    <select name="fallas">
    <?php
    $sql = "select nombre, id_falla from fallas; ";
    $consulta = $bd->query($sql);

    // Recorrer todos los registros para crear los option de la lista
    while($registro = $consulta->fetch()){ ?>

        <!-- El value del option tiene que ser el id de la falla -->
        <!-- Si el option a imprimir es el elegido y enviado, lo marca como selected -->
        <option value="<?php echo $registro['id_falla'] ?>"
        <?php if (!empty($_POST["fallas"]) && $_POST["fallas"] == $registro['id_falla']) 
        echo 'selected' ?>>

            <!-- Poner el nombre de la falla al option -->
            <?php echo $registro['nombre'] ?>
        </option>
            <?php } ?>
    </select>
        <br><br>
        <label for="presupuesto">Presupuesto:</label>

        <!-- Input para el presupuesto -->
        <input type="number" name="presupuesto" id="presupuesto">
        <br><br>
        <label for="fechaFundacionFalla">Fecha de fundacion de la falla:</label>

        <!-- Input para la fecha de fundacion de la falla -->
        <input type="date" name="fechaFundacionFalla" id="fechaFundacionFalla">
        <br><br>
        
        <!-- Imprimir el botón de submit -->
        <input type="submit" name="Enviar formulario">
        <br><br>
    </form>
<?php
// Si la conexión no ha tenido éxito se indica  
} catch (PDOException $e) {
  echo "Error con la base de datos: ". $e->getMessage();
}


if (!empty($_POST['presupuesto'])){
  try {
      $bd->beginTransaction();

      // Crear la actualización
      $sql = "update fallas set presupuesto = ? where id_falla = ?";

      // Preparar la consulta
      $pdoPreparada = $bd->prepare($sql);
      $arrParametros = [$_POST['presupuesto'], $_POST['fallas']];

      // Ejecutar la consulta preparada
      $resultado = $pdoPreparada->execute($arrParametros);

      // Si no se ha podido actualizar se lanza el error
      if (!$resultado) throw new Exception('No se ha podido realizar la actualización del presupuesto.<br>');

      // Si se ha podido actualizar se indica
      echo "Actualización presupuesto correcta<br>";
      echo "Cantidad de registros actualizados: ".$pdoPreparada->rowCount()."<br><br>";

      // Confirmar los cambios provisionales de forma permanente con commit
      $bd->commit();
  
  // si la conexión no ha tenido éxito se indica
  } catch (PDOException $e) {
      echo "Error en la BD: ". $e->getMessage();
      
      // Se deshace la transacción
      $bd->rollback();
  }

  try {
      $bd->beginTransaction();

      // Crear la actualización
      $sql = "select * from falleros where id_falla = ?";

      // Preparar la consulta
      $pdoPreparada = $bd->prepare($sql);

      // Ejecutar la consulta preparada
      $resultado = $pdoPreparada->execute([$_POST['fallas']]);

      // Calculo de cuota
      $cuotaFalleros = $_POST['presupuesto'] / $pdoPreparada->rowCount();

      // Crear actualización
      $sql = "update falleros set cuota = ? where id_falla = ?";

      // Preparar consulta
      $pdoPreparada = $bd->prepare($sql);

      // preparar array para la ejecucion de la consulta
      $arrParametros = [round($cuotaFalleros, 2) , $_POST['fallas']];

      // Ejecutar la consulta preparada
      $resultado = $pdoPreparada->execute($arrParametros);

      // Si no se ha podido actualizar se lanza el error
      if (!$resultado) throw new Exception('No se ha podido realizar la actualización la cuota.<br>');

      // Si se ha podido actualizar se indica
      echo "Actualización cuota correcta<br>";
      echo "Cantidad de registros actualizados: ".$pdoPreparada->rowCount()."<br><br>";

      // Confirmar los cambios provisionales de forma permanente con commit
      $bd->commit();
  
  // Si la conexión no ha tenido éxito se indica
  } catch (PDOException $e) {
      echo "Error en la BD: ". $e->getMessage();
      
      // Se deshace la transacción
      $bd->rollback();
  }
}

if (!empty($_POST['fechaFundacionFalla'])){
  try {
      $bd->beginTransaction();

      // Crear la actualización
      $sql = "update fallas set fecha_fundacion = ? where id_falla = ?";

      // Preparar la consulta
      $pdoPreparada = $bd->prepare($sql);
      $fecha = new DateTime($_POST['fechaFundacionFalla']);
      $arrParametros = [$fecha->format('Y-m-d'), $_POST['fallas']];

      // Ejecutar la consulta preparada
      $resultado = $pdoPreparada->execute($arrParametros);

      // Si no se ha podido actualizar se lanza el error
      if (!$resultado) throw new Exception
      ('No se ha podido realizar la actualización de la fecha_fundacion.<br>');

      // Si se ha podido actualizar se indica
      echo "Actualización fecha_fundacion correcta<br>";
      echo "Cantidad de registros actualizados: ".$pdoPreparada->rowCount()."<br><br>";

      // Confirmar los cambios provisionales de forma permanente con commit
      $bd->commit();
  
  // Si la conexión no ha tenido éxito se indica
  } catch (PDOException $e) {
      echo "Error en la BD: ". $e->getMessage();
      
      // Se deshace la transacción
      $bd->rollback();
  }
}

    
?>

<?php
// Función para obtener el nombre del mes en español
function obtenerMes($fecha) {
    $meses = [
        '01' => 'enero', '02' => 'febrero', '03' => 'marzo',
        '04' => 'abril', '05' => 'mayo', '06' => 'junio',
        '07' => 'julio', '08' => 'agosto', '09' => 'septiembre',
        '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre'
    ];

    $numeroMes = date('m', strtotime($fecha));
    return $meses[$numeroMes];
}

// Función para cambiar la fecha en español
function cambioFecha($fecha) {
    $dia = date('j', strtotime($fecha));
    $nombreMes = obtenerMes($fecha);
    $anyo = date('Y', strtotime($fecha));

    return $dia . ' de ' . $nombreMes . ' de ' . $anyo;
}

// Consulta para obtener información de la falla seleccionada
$sqlFalla = "SELECT nombre, fecha_fundacion, presupuesto FROM fallas 
WHERE id_falla = " . $_POST["fallas"];

$consultaFalla = $bd->query($sqlFalla);

// Obtener información de la falla como un array asociativa
$fallaInfo = $consultaFalla->fetch();

// Consulta para obtener información de los falleros de la falla seleccionada
$sqlFalleros = "SELECT dni, CONCAT(nombre, ' ', apellidos) 
AS fallero, cuota FROM falleros 
WHERE id_falla = " . $_POST["fallas"];

$consultaFalleros = $bd->query($sqlFalleros);

?>

<!-- Tabla de la falla -->
<table border="2">
    <tr>
        <th colspan="2"><?php echo $fallaInfo['nombre']; ?></th>
    </tr>
    <tr>
        <td><b>Fundación</b></td>
        <!-- Utilizar la función cambioFecha para poner la fecha en español -->
        <td><?php echo cambioFecha($fallaInfo['fecha_fundacion']); ?></td>
    </tr>
    <tr>
        <td><b>Presupuesto</b></td>
        <td><?php echo number_format($fallaInfo['presupuesto'], 2, ',', '.')
        . ' €'; ?></td>
    </tr>
</table>
<br>

<!-- Tabla de falleros -->
<table border="2">
    <tr>
        <th>DNI</th>
        <th>Fallero/a</th>
        <th>Cuota</th>
    </tr>

<?php
  // Recorrer los resultados de la consulta de falleros
  while ($fallero = $consultaFalleros->fetch()) {
      echo '<tr>';
      echo '<td>' . $fallero['dni'] . '</td>';
      echo '<td>' . $fallero['fallero'] . '</td>';
      echo '<td>' . number_format($fallero['cuota'], 2, ',', '.') . ' €</td>';
      echo '</tr>';
  }
?>
</table>

  </div>

  <div>
    <!-- pie de la aplicación -->
    <?php require 'base/pie.php' ?>

  </div>

<!-- --------------------------------------------------------------------------------------
CODIGO JAVASCRIPT
--------------------------------------------------------------------------------------- -->
<script type="text/javascript">


</script>

</body>
</html>
