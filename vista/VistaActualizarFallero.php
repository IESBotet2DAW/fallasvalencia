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
      <!-- Formulario para actualizar datos de los falleros -->
      <form method="POST" action="../controlador/ControladorFalleros.php">
        <label for="dni">DNI del Fallero: </label>
        <input type="text" name="dni" required>
        <br><br>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre">
        <br><br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos">
        <br><br>
        <label for="cuota">Cuota: </label>
        <input type="number" name="cuota">
        <br><br>
        <label for="id_falla">ID de Falla: </label>
        <input type="number" name="id_falla">
        <br><br>
        <input type="submit" value="Actualizar Datos">
    </form>

  </div>

  <div>
    <!-- pie de la aplicación -->
    <?php require 'base/pie.php' ?>

  </div>

</body>
</html>
