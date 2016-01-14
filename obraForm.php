<?php
/**
 * Este formulario se utiliza para crear y editar Rubros
 */

// título de la página
$titulo = "Obra";

// requerimientos
include('./coneccionBd.php');
include('./header.php');

// inicio las variables
$id = "";
$nombre = "";
$descripcion = "";

/**
 * Si se trata de una nueva obra
 */
// defino la variable accion que va a usar la pág. resultado
$accion = "crear";

// Obtener la id que se incrementa de forma automática
// http://stackoverflow.com/a/15821543
$consulta2 = "  SELECT `AUTO_INCREMENT`
                FROM  INFORMATION_SCHEMA.TABLES
                WHERE TABLE_SCHEMA = '$baseDeDatos'
                AND   TABLE_NAME   = 'obra'";
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
    $sql = "SELECT nombre, descripcion from obra WHERE id = $id ";
    $valores = consultaDb($sql);

    // Paso los campos a variables
    foreach ($valores as $valor) {
        $valor[] = $valor;
    }
    $nombre = $valor['nombre'];
    $descripcion = $valor['descripcion'];
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
$consultaInsumos = "SELECT R.nombre, R.id, R.unMetrica, M.unidad, X.id_rubro, X.cantidad
                    FROM rubro as R
                    JOIN rubroXobra as X ON X.id_rubro = R.id AND X.id_obra = $id
                    LEFT JOIN unMetrica as M ON R.unMetrica = M.id";
$valoresInsumos = consultaDb($consultaInsumos);

/* Cerrar conexión ************************************************************/
mysqli_close($link)

?>

<?php
// Mensaje de acción realizada
if (isset($_GET['mensaje']))
    echo "<div id=\"alerta\">Obra actualizada</div>";
?>

<div class="encabezado">

    <div class="table cien">
        <div class="row ">
            <span class="float-l"><h1><?php echo $titulo; ?></h1></span>
            <span class="float-r rOculto" style="margin-left:20px" > <a href="./obras.php" class="boton">Volver</a></span>
            <?php if (isset($_GET['id'])){ ?>
                <span class="float-r" > <a href="./obraListamat.php?id=<?php echo $id?>&nombre=<?php echo $nombre ?>" class="boton rojo rText"><i class="material-icons">list</i>Obtener lista de materiales</a></span>
            <?php } ?>
        </div>
    </div>
</div>

<article>
    <!-- Formulario Obra -->
    <section class="formTop angosto">
        <form action="obraResultado.php" method="post" onsubmit="return validarObra();">
            <div class="table cien">
                <div class="row">
                    <span class="cell">
                        <span class="descripcion">Nombre</span>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>">
                        <span id="nombreError" class="errorTxt"></span>
                    </span>
                </div>
                <div class="row">
                    <span class="cell">
                        <span class="descripcion">Descripción</span>
                        <textarea name="descripcion" id="descripcion" rows="2"><?php echo $descripcion; ?></textarea>
                        <span id="descripcionError" class="errorTxt"></span>
                    </span>
                </div>
            </div>
            <div class="table cien">
                <div class="row">
                    <span class="cell w33">
                        <?php
                        if ($accion == "editar")
                        echo '<input class="boton alerta submit borrar" type="submit" onclick="return confirm(\'¿Seguro de eliminar la obra?\');" name="borrar" value="ELIMINAR">';
                        ?>
                    </span>
                    <span class="cell w33"></span>
                    <span class="cell w33">
                        <input class="boton blanco submit" type="submit" name="guardar" value="GUARDAR">
                    </span>
                </div>
            </div>

            <!-- Oculto: para pasar la acción [crear, editar] -->
            <input type="hidden" name="accion" value="<?php echo $accion; ?>">
            <!-- y para pasar el id -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </form>
    </section>

    <!-- Lista de rubros -->
    <?php if (isset($_GET['id'])){ ?>
        <section class="listado">
            <div class="table cien p20">
                <div class="row">
                    <span class="cell">
                        <h2>Rubros</h2>
                    </span>
                    <span class="cell">
                        <a  href="./rubroXobraForm.php?id_obra=<?php echo $id; ?>" class="boton rojo rText"><i class="material-icons">add</i>Agregar Rubro</a>
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
                        <span class="descripcion encabeazdo">Cantidad</span>
                    </span>
                </div>

                <?php
                if ($valoresInsumos){
                    foreach ($valoresInsumos as $valor) {
                        ?>
                        <a class="row" href="./rubroXobraForm.php?id_obra=<?php echo $id; ?>&id=<?php echo $valor['id'];?>">
                            <span class="cell">
                                <?php echo $valor['nombre']; ?>
                            </span>
                            <span class="cell">
                                <?php echo $valor['unidad']; ?>
                            </span>
                            <span class="cell">
                                <?php echo $valor['cantidad']; ?>
                            </span>
                        </a>
                        <?php }
                } ?>
            </div>
        </section>
    <?php } ?>
    </section>
</article>

<?php include('./footer.php'); ?>
