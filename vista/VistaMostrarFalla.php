<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VistaMostrarFalla</title>
        <style>
            .imagenes {
            width: 150px; 
            }

            #tablaFalla {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px; 
            }

            #tablaFalla th, #tablaFalla td {
                border: 1px solid #ddd; 
                padding: 8px;
                text-align: left; 
            }

            #tablaFalla th {
                background-color: #f2f2f2; 
            }
        </style>
    </head>
    <body>
        
    </body>
    </html>
    <!-- Cabecera de la aplicación -->
    <?php require 'base/cabecera.php';?>
    
    <!-- ------------------------------------------------------------------------------------------
    CUERPO DE LA VISTA
    ------------------------------------------------------------------------------------------- -->

    <body>
        <div class="areaTrabajo"> 
            <div class="tituloPagina">
                <h1>Consulta de fallas</h1>
            </div>
        
            <!-- se define la vista activa -->
            <?php $vistaActiva = 'VistaMostrarFalla'; ?>

            <!-- menú principal de la aplicación -->
            <?php require 'base/menu.php' ?>
            <div class="areaFormulario">
                <form id= "mostrarFallaForm" name="mostrarFallaForm" action="VistaMostrarFalla.php" method="POST">
                    <input type="hidden" id="idFalla" name="idFalla" value="1" />
                    <label for="selectFalla">Selecciona la falla:</label>
                    <select name="selectFalla" id="selectFalla" title="Selector de la falla"></select><br>
                </form>
                <table id="tablaFalla">
                <tr>
                    <th>Imagen</th>
                    <td id="imagenFalla"></td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td id="nombreFalla"><div></div></td>
                </tr>
                <tr>
                    <th>Fecha de fundación</th>
                    <td id="fechaFalla"></td>
                </tr>
                <tr>
                    <th>Presupuesto</th>
                    <td id="presupuestoFalla"></td>
                </tr>
                </table>
            </div>
            <!-- pie de la aplicación -->
            <?php require 'base/pie.php' ?>
        </div>
        <!-- --------------------------------------------------------------------------------------
        CODIGO JAVASCRIPT
        --------------------------------------------------------------------------------------- -->
        <script type="text/javascript">
            // definición de todas las funciones ajax cuando el documento está preparado
            $(document).ready(function() {
                let arrFallas;
                let fallaSelected;
                let idFalla = 0;
                cargarFallas();
                function cargarFallas() {
                    $.post("/fallasvalencia/fallaReceptor.php",{accion:"cargarFallas"}, function(data, status) {

                        // se transforma el valor json recibido en array
                        resetearTabla();
                        arrData = JSON.parse(data);
                        // se refresca la tabla
                        arrFallas = arrData[1];
                        idFalla = "<?php echo isset($_GET['idFalla'])? $_GET['idFalla']: 0 ?>";
                        refrescarSelect(arrFallas);
                    });
                }
                
                $("#selectFalla").change(function() {
                    resetearTabla();
                    var idF = $('#selectFalla').find(":selected").val();
                    fallaSelected = arrFallas.find(f => f.id_falla === parseInt(idF));
                    if (fallaSelected !== null && fallaSelected !== undefined) {
                        if (idFalla != fallaSelected.id_falla) {
                            idFalla = fallaSelected.id_falla;
                            window.location.replace("/fallasvalencia/falla/"+fallaSelected.id_falla);
                        } else {
                            let imagenFalla = "/fallasvalencia/res/fallas/" + fallaSelected.id_falla + ".png";
                            $("td#imagenFalla").html("<img class='imagenes' src='" + imagenFalla + "' alt='" + fallaSelected.nombre + "'>");
                            $("td#nombreFalla").html(fallaSelected.nombre);
                            $("td#fechaFalla").html(formatearFecha(fallaSelected.fechaFundacion) + " (" + fallaSelected.edad + ")");
                            $("td#presupuestoFalla").html(fallaSelected.presupuesto + "€");
                            $("#idFalla").val(fallaSelected.id_falla);
                        }
                    }
                });
                
                function refrescarSelect(arrFallas) {
                    // Se limpia la lista de fallas
                    $("#selectFalla option").remove();
                    
                    arrFallas.forEach(function(falla) {
                        // Se agrega la opción al select con la URL de la imagen como valor
                        $("#selectFalla").append('<option value="' + falla.id_falla + '" data-imagen="' + falla.imagenURL + '">' + falla.nombre + '</option>');
                    });
                    $("#selectFalla option[value='"+ idFalla + "']").attr("selected", true).change();
                }

                function resetearTabla() {
                    $("#imagenFallaSrc").attr("src", ""); 
                    $("td#nombreFalla").html("");
                    $("td#fechaFalla").html("");
                    $("td#presupuestoFalla").html("");
                }

                function formatearFecha(fecha) {
                    var f = new Date(fecha);
                    var anio = f.getFullYear();

                    var mes = (1 + f.getMonth()).toString();
                    mes = mes.length > 1 ? mes : '0' + mes;

                    var dia = f.getDate().toString();
                    dia = dia.length > 1 ? dia : '0' + dia;

                    return dia + '/' + mes + '/' + anio;
                }
            });
        </script>
    </body>
</html>
