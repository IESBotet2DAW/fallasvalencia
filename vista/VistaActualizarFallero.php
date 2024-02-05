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
class VistaActualizarFallero {
    public function mostrarFormulario($dni, $falleroInfo = []) {
?>

    <form action="fallero.php" method="POST">
        <label for="dni">DNI:</label>
        <input type="text" name="dni" value="<?php echo $dni; ?>" readonly>
        <br><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"
        value="<?php echo isset($falleroInfo['nombre']) ? $falleroInfo['nombre'] : ''; ?>">
        <br><br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos"
        value="<?php echo isset($falleroInfo['apellidos']) ? $falleroInfo['apellidos'] : ''; ?>">
        <br><br>
        <label for="cuota">Cuota:</label>
        <input type="number" name="cuota"
        value="<?php echo isset($falleroInfo['cuota']) ? $falleroInfo['cuota'] : ''; ?>">
        <br><br>
        <label for="id_falla">ID Falla:</label>
        <input type="number" name="id_falla"
        value="<?php echo isset($falleroInfo['id_falla']) ? $falleroInfo['id_falla'] : ''; ?>">
        <br><br>
        <input type="submit" value="Actualizar datos del fallero">
    </form>

<?php
    }
}
?>

  </div>

  <div>
    <!-- pie de la aplicación -->
    <?php require 'base/pie.php' ?>

  </div>

</body>
</html>
