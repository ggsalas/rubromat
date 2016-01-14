<?php
/**
 * Este formulario agrega un rubro a una obra
 */

// título de la página
$titulo = "Añadir un rubro a la obra";

// requerimientos
include('./coneccionBd.php');
include('./header.php');

// inicio las variables
$id_obra = $_GET['id_obra'];
$id = ""; // la id del insumo
$cantidad = "";

// Si el insumo lo obtengo con el buscador de insumos
$Bid_rubro = isset($_GET['Bid_rubro']) ? $_GET['Bid_rubro'] : 0;

$accion = "crear";

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
    $sql = "SELECT cantidad
            FROM rubroXobra
            WHERE id_rubro= $id AND id_obra = $id_obra";
    $valores = consultaDb($sql);

    // Paso los campos a variables
    foreach ($valores as $valor) {
        $valor[] = $valor;
    }
    // $id = $valor['id_insumo'];
    $cantidad = $valor['cantidad'];
}

/**
 * Extraigo Valores de tabla rubros (para completar el desplegable)
 */
// Consulto todos los datos
// Se quitan del desplegable los insumos YA utilizados en el rubro
if (isset($_GET['id']) && $_GET['id'] > 0){
    // Consulta que incluye el insumo actual (en editar)
    $consultaRubros = "SELECT R.id, R.nombre, R.unMetrica,  M.unidad
                        from rubro AS R
                        LEFT JOIN unMetrica as M ON R.unMetrica = M.id
                        LEFT JOIN rubroXobra as X ON R.id = X.id_rubro AND X.id_obra = $id_obra
                        WHERE X.id_rubro = $id OR X.id_rubro IS NULL";
}
else {
    // Consulta que No incluye el insumo actual, porque no existe (agrenar nuev insumo)
    $consultaRubros = "SELECT R.id, R.nombre, R.unMetrica,  M.unidad
                        from rubro AS R
                        LEFT JOIN unMetrica as M ON R.unMetrica = M.id
                        LEFT JOIN rubroXobra as X ON R.id = X.id_rubro AND X.id_obra = $id_obra
                        WHERE X.id_rubro IS NULL";
}

// Hace la consulta
$valoresRubros = consultaDb($consultaRubros);

/* Cerrar conexión ************************************************************/
mysqli_close($link)

?>

<?php
// Mensaje de acción realizada
if (isset($_GET['mensaje']))
    echo "<div id=\"alerta\">Obra actualizada</div>";
?>

<div class="encabezado">
    <h1><?php echo $titulo; ?></h1>
    <span class="float-r rOculto">
        <a href="./obraForm.php?id=<?php echo $id_obra; ?>" class="boton">Volver</a>
    </span>
</div>

<article>
    <!-- Formulario Rubro -->
    <section class="formTop">
        <form action="rubroXobraResultado.php" method="post" onsubmit="return validarRubroXobra();">
            <div class="table cien">
                <div class="row">
                    <span class="cell">
                        <div class="table cien rUnaLinea">
                            <div class="row">
                                <span class="cell">
                                    <span class="descripcion">Seleccionar Rubro</span>
                                    <select name="id_rubro">
                                        <?php
                                        foreach ($valoresRubros as $valor) {
                                            // Si se seleccionó un elemento en la búsqueda de insumos (existe variable $Bid_insumo)
                                            if ( $Bid_rubro > 0 && $Bid_rubro == $valor['id'])
                                                $seleccionado = 'selected="selected"';

                                            // Si es una edición
                                            else if ($Bid_rubro == 0 && $id == $valor['id'])
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
                                    <a href="./Buscar.php?tipo=rubro&id_obra=<?php echo $id_obra ?>&id=<?php echo $id; ?>" class="boton grande"><i class="material-icons">search</i></a>
                                </span>
                            </div>
                        </div>
                    </span>
                    <span class="cell">
                        <span class="descripcion">Cantidad</span>
                        <input type="text" name="cantidad" id="cantidad" size="5" value="<?php echo $cantidad ?>">
                        <span id="cantidadError" class="errorTxt"></span>
                    </span>
                </div>
            </div>
            <div class="table cien">
                <div class="row">
                    <span class="cell w33">
                        <?php
                        if ($accion == "editar")
                            echo '<input class="boton alerta submit borrar" type="submit" onclick="return confirm(\'¿Seguro de eliminar la asignación de este rubro a la obra?\');" name="borrar" value="BORRAR">';
                        ?>
                    </span>
                    <span class="cell w33"></span>
                    <span class="cell w33">
                        <!-- !Oculto: pasa la id del rubro -->
                        <input type="hidden" name="id_obra" value="<?php echo $id_obra; ?>">
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
