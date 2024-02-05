<!-- ------------------------------------------------------------------------------------------
VistaLogin
------------------------------------------------------------------------------------------- -->

<!doctype html>
<html lang="en">

<!-- Cabecera de la aplicación -->
<?php require 'base/cabecera.php' ?>



<!-- ------------------------------------------------------------------------------------------
CUERPO DE LA VISTA
------------------------------------------------------------------------------------------- -->

<body>


    <!-- se indica el título de la página -->
    <div class="tituloPagina">
        <h1>Gestión de fallas</h1>
    </div>

    <!-- se define la vista activa -->
    <?php $vistaActiva = 'VistaInsertarMonumento'; ?>

    <!-- menú principal de la aplicación -->
    <?php require 'base/menu.php' ?>

    <form action="insertarMonumento.php" method="post">
        <input type="hidden" value="insertar" name="accion">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre">
        <label for="lema">Lema</label>
        <input type="text" id="lema" name="lema">
        <label for="presupuesto">Presupuesto</label>
        <input type="number" min="0" id="presupuesto" name="presupuesto">
        <label for="anyo_creacion">Año creación</label>
        <input type="date" id="anyo_creacion" name="anyo_creacion">
        <select name="idFalla">
            <?php for ($i = 0; $i < count($arrFallas); $i++) { ?>
                <option value="<?php echo $arrFallas[$i]['id_falla'] ?>">
                    <?php echo $arrFallas[$i]['nombre'] ?>
                </option>
            <?php } ?>
        </select>
        <input type="submit" value="Insertar">
    </form>

    <!-- pie de la aplicación -->
    <?php require 'base/pie.php' ?>



</body>

</html>