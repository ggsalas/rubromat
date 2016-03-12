<?php
/**
 * Este formulario agrega un insumo a un rubro
 */
// requerimiento
include('./coneccionBd.php');

// inicio las variables
$id_rubro = $_GET['id_rubro'];
$id = ""; // la id del insumo
$rendimiento = "";
// Si el insumo lo obtengo con el buscador de insumos
$Bid_insumo = isset($_GET['Bid_insumo']) ? $_GET['Bid_insumo'] : 0;

$accion = "crear";

// título de la página
$titulo = "Añadir un insumo a: " . tituloNombre('rubro', $id_rubro, 1);

/**
 * verifico si se trata de una edición, chequeando si existe
 * el parámetro ID por GET
 */
// Consulto todos los datos
if (isset($_GET['id']) && $_GET['id'] > 0){

    // si existe, entonces:
    $accion = "editar";

    // la id del insumo:
    $id = $_GET['id'];

    // Entonces, Consulto todos los datos del campo que voy a editar
    $sql = "SELECT rendimiento
            FROM insumoXrubro
            WHERE id_insumo= $id AND id_rubro = $id_rubro";
    $valores = consultaDb($sql);

    // Paso los campos a variables
    foreach ($valores as $valor) {
        $valor[] = $valor;
    }
    // $id = $valor['id_insumo'];
    $rendimiento = $valor['rendimiento'];
}

/**
 * Extraigo Valores de tabla insumos (para completar el desplegable)
 */
// Consulto todos los datos
// Se quitan del desplegable los insumos YA utilizados en el rubro
if (isset($_GET['id']) && $_GET['id'] > 0){
    // Consulta que incluye el insumo actual (en editar)
    $consultaInsumos = "SELECT I.id, I.nombre, I.unMetrica,  M.unidad
                        from insumo AS I
                        LEFT JOIN unMetrica as M ON I.unMetrica = M.id
                        LEFT JOIN insumoXrubro as X ON I.id = X.id_insumo AND X.id_rubro = $id_rubro
                        WHERE X.id_insumo = $id OR X.id_insumo IS NULL";
}
else {
    // Consulta que No incluye el insumo actual, porque no existe (agrenar nuev insumo)
    $consultaInsumos = "SELECT I.id, I.nombre, I.unMetrica,  M.unidad
                        from insumo AS I
                        LEFT JOIN unMetrica as M ON I.unMetrica = M.id
                        LEFT JOIN insumoXrubro as X ON I.id = X.id_insumo AND X.id_rubro = $id_rubro
                        WHERE X.id_insumo IS NULL";
}

// Hace la consulta
$valoresInsumos = consultaDb($consultaInsumos);

/* Cerrar conexión ************************************************************/
mysqli_close($link);


// requerimiento
include('./header.php');
?>

<?php
// Mensaje de acción realizada
if (isset($_GET['mensaje']))
    echo "<div id=\"alerta\">Rubro actualizado</div>";
?>

<div class="encabezado">
    <h1><?php echo $titulo; ?></h1>
    <span class="float-r rOculto">
        <a href="./rubroForm.php?id=<?php echo $id_rubro; ?>" class="boton">Volver</a>
    </span>
</div>

<article>
    <!-- Formulario Rubro -->
    <section class="formTop">
        <form action="insumoXrubroResultado.php" method="post" onsubmit="return validarInsumoXrubro();">
            <div class="table cien">
                <div class="row">
                    <span class="cell">
                        <div class="table cien rUnaLinea">
                            <div class="row">
                              <span class="cell">
                                  <span class="descripcion">Seleccionar Insumo</span>
                                  <select class="" name="id_insumo">
                                    <?php
                                    foreach ($valoresInsumos as $valor) {
                                        // Si se seleccionó un elemento en la búsqueda de insumos (existe variable $Bid_insumo)
                                        if ( $Bid_insumo > 0 && $Bid_insumo == $valor['id'])
                                            $seleccionado = 'selected="selected"';

                                        // Si es una edición
                                        else if ($Bid_insumo == 0 && $id == $valor['id'])
                                            $seleccionado = 'selected="selected"';

                                        // Si es un nuevo insumo
                                        else
                                            $seleccionado = '';

                                        // Crear la lista desplegable
                                        echo '<option value="' . $valor['id'] . '" '.$seleccionado.' >[' . $valor['unidad'] .'] '. $valor['nombre'].'</option>';
                                    }
                                    ?>
                                  </select>
                              </span>
                              <span class="cell">
                                  <a href="./Buscar.php?tipo=insumo&id_rubro=<?php echo $id_rubro ?>&id=<?php echo $id; ?>" class="boton grande"><i class="material-icons">search</i></a>
                              </span>
                            </div>
                        </div>
                    </span>
                    <span class="cell">
                        <span class="descripcion">Rendimiento</span>
                        <input type="text" id="rendimiento" name="rendimiento" size="5" value="<?php echo $rendimiento ?>">
                        <span id="rendimientoError" class="errorTxt"></span>
                    </span>
                </div>
            </div>
            <div class="table cien">
                <div class="row">
                    <span class="cell w33">
                        <?php
                        if ($accion == "editar")
                            echo '<input class="boton alerta submit borrar" onclick="return confirm(\'¿Seguro de eliminar la asignación de este insumo al rubro?\');" type="submit" name="borrar" value="BORRAR">';
                        ?>
                    </span>
                    <span class="cell w33"></span>
                    <span class="cell w33">
                        <!-- !Oculto: pasa la id del rubro -->
                        <input type="hidden" name="id_rubro" value="<?php echo $id_rubro; ?>">
                        <!-- Oculto: para pasar la acción [crear, editar] -->
                        <input type="hidden" name="accion" value="<?php echo $accion; ?>">
                        <!-- y para pasar el id -->
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input class="boton blanco submit" type="submit" name="guardar" value="GUARDAR">
                    </span>
                </div>
            </div>
        </form>
    </section>
</article>
<?php include('./footer.php'); ?>
