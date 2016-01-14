<?php
/**
 * Este formulario se utiliza para crear y editar Rubros
 */

// título de la página
$titulo = "Rubro";

// requerimientos
include('./coneccionBd.php');
include('./header.php');

// inicio las variables
$id = "";
$nombre = "";
$unMetrica = "";
$rendimiento[] = "";

/**
 * Si se trata de un nuevo rubro
 */
// defino la variable accion que va a usar la pág. resultado
$accion = "crear";

// Obtener la id que se incrementa de forma automática
// http://stackoverflow.com/a/15821543
$consulta2 = "  SELECT `AUTO_INCREMENT`
                FROM  INFORMATION_SCHEMA.TABLES
                WHERE TABLE_SCHEMA = '$baseDeDatos'
                AND   TABLE_NAME   = 'rubro'";
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
    $sql = "SELECT nombre, unMetrica from rubro WHERE id = $id ";
    $valores = consultaDb($sql);

    // Paso los campos a variables
    foreach ($valores as $valor) {
        $valor[] = $valor;
    }
    $nombre = $valor['nombre'];
    $unMetrica = $valor['unMetrica'];
}

/**
 * Extraigo Valores de tabla unMetrica (para completar el desplegable)
 */
// Consulto todos los datos
$consultaUnMetrica = "SELECT id, unidad from unMetrica ";

// Hace la consulta
$valoresUnMetrica = consultaDb($consultaUnMetrica);

/**
 * Consulta datos de insumos
 * JOIN con insumoXrubro para mostrar *solo* los mat. que pertenecen al rubro
 * LEFT JOIN con tabla unMetrica: para tener nombres de unidades
 */
$consultaInsumos = "SELECT I.nombre, I.id, I.unMetrica, M.unidad, X.id_insumo, X.id_rubro, X.rendimiento
                    FROM insumo as I
                    JOIN insumoXrubro as X ON X.id_insumo = I.id AND X.id_rubro = $id
                    LEFT JOIN unMetrica as M ON I.unMetrica = M.id";
$valoresInsumos = consultaDb($consultaInsumos);

/* Cerrar conexión ************************************************************/
mysqli_close($link)

?>

<?php
// Mensaje de acción realizada
if (isset($_GET['mensaje']))
    echo "<div id=\"alerta\">Rubro actualizado</div>";
?>

<div class="encabezado">
    <h1><?php echo $titulo; ?></h1>
    <a href="./rubros.php" class="boton">Lista de rubros</a>
</div>

<article>
    <!-- Formulario Rubro -->
    <section class="formTop angosto">
        <form action="rubroResultado.php" method="post" onsubmit="return validarRubro();">
            <div class="table cien">
                <div class="row">
                    <span class="cell w75">
                        <span class="descripcion">Nombre</span>
                        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>">
                        <span id="nombreError" class="errorTxt"></span>
                    </span>
                    <span class="cell">
                        <span class="descripcion">Unidad</span>
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
                    </span>
                </div>
            </div>
            <div class="table cien">
                <div class="row">
                    <span class="cell w33">
                        <?php
                            if ($accion == "editar")
                                echo '<input class="boton alerta submit borrar" onclick="return confirm(\'¿Seguro de eliminar el rubro?\');" type="submit" name="borrar" value="ELIMINAR">';
                        ?>
                    </span>
                    <span class="cell w33"></span>
                    <span class="cell w33">
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

    <!-- Lista de insumos -->
    <?php if (isset($_GET['id'])){ ?>
        <section class="listado">
            <div class="table cien p20">
                <div class="row">
                    <span class="cell">
                        <h2>Insumos</h2>
                    </span>
                    <span class="cell">
                        <a  href="./insumoXrubroForm.php?id_rubro=<?php echo $id; ?>" class="boton rojo rText"><i class="material-icons">add</i>Agregar Insumo</a>
                    </span>
                </div>
            </div>

            <div  class="table lineas cien">
                <div class="row cabecera">
                    <span class="cell w75">
                        <span class="descripcion encabeazdo">Nombre</span>
                    </span>
                    <span class="cell">
                        <span class="descripcion encabeazdo">Unidad</span>
                    </span>
                    <span class="cell">
                        <span class="descripcion encabeazdo"><abb title="Cantidad de unidades del material por cada unidad del rubro">Rendimiento</abb></span>
                    </span>
                </div>

                <?php
                if ($valoresInsumos){
                    foreach ($valoresInsumos as $valor) {
                        ?>
                        <a class="row" href="./insumoXrubroForm.php?id_rubro=<?php echo $id; ?>&id=<?php echo $valor['id'];?>">
                            <span class="cell">
                                <?php echo $valor['nombre']; ?>
                            </span>
                            <span class="cell">
                                <?php echo $valor['unidad']; ?>
                            </span>
                            <span class="cell">
                                <?php  echo $valor['rendimiento']; ?>
                            </span>
                        </a>
                        <?php }
                } ?>
            </div>
        </section>
    <?php } ?>

    </form>
</article>
<?php include('./footer.php'); ?>
