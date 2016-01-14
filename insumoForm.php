<?php
/**
 * Este formulario se utiliza para crear y editar insumos
 */

// título de la página
$titulo = "Insumo";

// requerimientos
include('./coneccionBd.php');
include('./header.php');

// inicio las variables
$id = "";
$nombre = "";
$unMetrica = "";
$unComercial = "";
$cantComercial = "";

// defino la variable accion que va a usar la pág. resultado
$accion = "crear";

// Obtener la id que se incrementa de forma automática
// http://stackoverflow.com/a/15821543
$consulta2 = "  SELECT `AUTO_INCREMENT`
                FROM  INFORMATION_SCHEMA.TABLES
                WHERE TABLE_SCHEMA = '$baseDeDatos'
                AND   TABLE_NAME   = 'insumo'";
$respuesta2 = consultaDb($consulta2);
foreach ($respuesta2 as $valor) {
    $id = $valor['AUTO_INCREMENT'];
}

/**
 * verifico si se trata de una edición, chequeando si existe
 * el parámetro ID por GET
 */
// Consulto todos los datos
if (isset($_GET['id'])){

    // si existe, entonces:
    $accion = "editar";

    // y la id del insumo está definida por:
    $id = $_GET['id'];

    // Entonces, Consulto todos los datos del campo que voy a editar
    $sql = "SELECT nombre, unMetrica, unComercial, cantComercial from insumo WHERE id = $id ";
    $valores = consultaDb($sql);

    // Paso los campos a variables
    foreach ($valores as $valor) {
        $valor[] = $valor;
    }
    $nombre = $valor['nombre'];
    $unMetrica = $valor['unMetrica'];
    $unComercial = $valor['unComercial'];
    $cantComercial = $valor['cantComercial'];
}

/**
 * Extraigo Valores de tabla unMetrica
 */
// Consulto todos los datos
$consultaUnMetrica = "SELECT id, unidad from unMetrica ";

// Hace la consulta
$valoresUnMetrica = consultaDb($consultaUnMetrica);

/**
 * Extraigo Valores de tabla unComercial
 */
// Consulto todos los datos
$consultaUnComercial = "SELECT id, unidad from unComercial ";

// Hace la consulta
$valoresUnComercial = consultaDb($consultaUnComercial);


/* Cerrar conexión ************************************************************/
mysqli_close($link);

// Mensaje de acción realizada
if (isset($_GET['mensaje']))
    echo "<div id=\"alerta\">Insumo actualizado</div>";
?>
<div class="encabezado">
    <h1>Insumo</h1>
    <a href="./insumos.php" class="boton">Lista de insumos</a>
</div>

<article>
    <section class="formTop">
        <form action="insumoResultado.php" method="post" onsubmit="return validarInsumo();">
            <div class="table cien">
                <div class="row">
                    <div class="cell">
                        <span class="descripcion">Nombre</span>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>">
                        <span id="nombreError" class="errorTxt"></span>
                    </div>
                </div>
            </div>

            <div class="table cien">
                <div class="row">
                    <div class="cell">
                        <span class="descripcion">Unidad métrica</span>
                        <select class="" name="unMetrica">
                            <?php
                            foreach ($valoresUnMetrica as $valor) {
                                // asignar "selected" si corresponde
                                if ( $unMetrica == $valor['id'] ){
                                    echo '<option value="' . $valor['id'] . '" selected="selected" >' . $valor['unidad'] .'</option>';
                                }
                                else {
                                    echo '<option value="' . $valor['id'] . '">' . $valor['unidad'] .'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="cell">
                        <span class="descripcion">Unidad comercial</span>
                        <select class="" name="unComercial">
                            <?php
                            foreach ($valoresUnComercial as $valor) {
                                // asignar "selected" si corresponde
                                if ( $unComercial == $valor['id'] ){
                                    echo '<option value="' . $valor['id'] . '" selected="selected" >' . $valor['unidad'] .'</option>';
                                }
                                else {
                                    echo '<option value="' . $valor['id'] . '">' . $valor['unidad'] .'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="cell">
                        <span class="descripcion">Cantidad comercial</span>
                        <input type="text" id="cantComercial" name="cantComercial" size="5" value="<?php echo $cantComercial ?>">
                        <span id="cantComercialError" class="errorTxt"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="cell">
                        <!-- Oculto: para pasar la acción [crear, editar] -->
                        <input type="hidden" name="accion" value="<?php echo $accion; ?>">
                        <!-- y para pasar el id -->
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <?php
                            if ($accion == "editar")
                                echo '<input class="boton alerta submit borrar" onclick="return confirm(\'¿Seguro de eliminar el insumo?\');" type="submit" name="borrar" value="Borrar">';
                        ?>
                    </div>
                    <div class="cell">

                    </div>
                    <div class="cell">
                        <input class="boton rojo submit" type="submit" name="guardar" value="Guardar">
                    </div>
                </div>
            </div>
        </form>
    </section>
</article>

<?php include('./footer.php'); ?>
