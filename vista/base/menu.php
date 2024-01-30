<!-- ------------------------------------------------------------------------------------------
MENU PRINCIPAL
------------------------------------------------------------------------------------------- -->

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: Purple;">
<div class="container-fluid">
    
    <!-- se inicializa el icono de menú -->
    <?php $iconoMenu = 'iconoVioletRelatos.png'; ?>

    <!-- se inicializa el array de items activos -->
    <?php $arrItemsActivos = array(
        'inicio' => '',
        'insertar' => '',
        'actualizar' => '',
        'eliminar' => '',
        'mostrar' => '',
        'listado' => ''
    ); ?>

    <!-- Se obtiene el item activo del menú -->
    <?php switch ($vistaActiva) {

        case 'VistaInsertarFalla': 
            $itemActivo = $arrItemsActivos['insertar'] = 'active'; 
            break;

        case 'VistaActualizarFalla':
            $itemActivo = $arrItemsActivos['actualizar'] = 'active';
            break;

        case 'VistaEliminarFalla':
            $itemActivo = $arrItemsActivos['eliminar'] = 'active';
            break;

        case 'VistaMostrarFalla':
            $itemActivo = $arrItemsActivos['mostrar'] = 'active';
            break;

        case 'VistaMostrarListadoFallas':
            $itemActivo = $arrItemsActivos['listado'] = 'active';
            break;

        case 'VistaLogin':
        default:
            $itemActivo = $arrItemsActivos['inicio'] = 'active';
            $iconoMenu = 'iconoBlancoRelatos.png';
            break;

    } ?>

    <!-- Icono de la aplicación para regresar al índice-->
    <!-- El efecto de cambio de color del icono se realiza en jquery en pie.php -->
    <a class="navbar-brand" href="/fallasvalencia/usuario">
        <img 
            class="iconoMenu" 
            src="/fallasvalencia/res/iconos/<?php echo $iconoMenu; ?>"
            alt=""         
            width="30" 
            height="24">
    </a>

    <!-- se añade el responsive del Navbar-->
    <button 
        class="navbar-toggler" 
        type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#navbarNavDropdown" 
        -controls="navbarNavDropdown" 
        aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- área para el resto de accesos del aplicación-->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
        
        <li class="nav-item">
            <a 
                class="nav-link itemMenu <?php echo $arrItemsActivos['insertar']; ?>" 
                aria-current="page" 
                href="vista/insertar/">Insertar</a></li>
        
        <li class="nav-item">
            <a 
                class="nav-link itemMenu <?php echo $arrItemsActivos['actualizar']; ?>" 
                href="vista/VistaActualizarFallero.php">Actualizar</a></li>
        
        <li class="nav-item">
            <a 
                class="nav-link itemMenu <?php echo $arrItemsActivos['eliminar']; ?>" 
                href="vista/eliminar/">Eliminar</a></li>
        
        <li class="nav-item">
            <a 
                class="nav-link itemMenu <?php echo $arrItemsActivos['mostrar']; ?>" 
                href="vista/mostrar/">Mostrar</a></li>
        
        <li class="nav-item">
            <a 
                class="nav-link itemMenu <?php echo $arrItemsActivos['listado']; ?>" 
                href="vista/listado/">Listado</a></li>
        
</ul>                

    <!-- Si el usuario está logeado se muestra el botón para cerrar sesión -->
    <?php if (isset($_SESSION['usuario'])) { ?>
  
        <!-- se muestra el botón  para cerrar sesión -->
        <form class="d-flex ms-auto mb-2 mb-lg-0" action="/fallasvalencia/controlador/logout.php" method="POST">
            <button class="btn btn-outline outlineViolet" type="submit">
                <span>
                    <i 
                        class="bi bi-power Violet" 
                        data-placement="top"
                        data-bs-toggle="tooltip"
                        data-bs-html="true"  
                        title="<em>Cerrar sesión</em>"
                        style="font-size:1rem; color:Violet;"></i>
                </span>
            </button>
        </form>

    <?php  } ?>

    </div>

</div>
</nav>
