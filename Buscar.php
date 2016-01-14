<?php
/**
 * Buscador de Insumos y Rubros
 * Esta página funciona como la de "resultados"
 * también se utiliza para encontrar y seleccionar en los formularios:
 * -insumoForm y en -rubroForm
 */

$bodyEstilos = "buscar";
$url = ""; // url a la que irá el link de cada elemento encontrado

// Variable a tomar por GET (por la misma página)
$texto = isset($_GET['texto']) ? $_GET['texto'] : ""; // Texto a buscar
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : $_POST['tipo']; // Buscar insumos o rubros


$id_rubro = isset($_GET['id_rubro']) ? $_GET['id_rubro'] : 0;
$id_obra = isset($_GET['id_obra']) ? $_GET['id_obra'] : 0;

// para botón de búsqueda de insumo-rubro
$id_antiguo = isset($_GET['id']) ? $_GET['id'] : 0;

// título
$tituloInsertar ="";
if ($tipo == "insumo" && $id_rubro > 0)
    $tituloInsertar =" a insertar en el rubro";
else if ($tipo == "rubro" && $id_obra > 0)
    $tituloInsertar = " a insertar en la obra" ;

$titulo = "Buscar " .$tipo . $tituloInsertar;

include('./coneccionBd.php');
include('./header.php');

/**
 * Decidir que hacer
 */
// ¿Qu+e buscar?
// Filtra por el texto buscado y excluye los insumos/rubros ya utilizados
if ($tipo == "rubro"){
    $consulta = "   SELECT nombre, id
                    from rubro as R
                    LEFT JOIN rubroXobra as X ON R.id = X.id_rubro AND X.id_obra = $id_obra
                    WHERE X.id_rubro IS NULL AND nombre LIKE '%$texto%'
                    ORDER BY nombre asc";
} else if ($tipo == "insumo"){
    $consulta = "   SELECT nombre, id
                    from insumo AS I
                    LEFT JOIN insumoXrubro as X ON I.id = X.id_insumo AND X.id_rubro = $id_rubro
                    WHERE X.id_insumo IS NULL AND nombre LIKE '%$texto%'
                    ORDER BY nombre asc";
}

// direccioines a utilizar en cada link de insumo-rubro
if ($tipo == "rubro"){
    if ($id_obra == 0)
        $url = "./rubroForm.php?id=";
    else
        $url = "./rubroXobraForm.php?id_obra=" .$id_obra. "&id=".$id_antiguo."&Bid_rubro=";
} else if ($tipo == "insumo"){
    if ($id_rubro == 0)
        $url = "./insumoForm.php?id=";
    else
        $url = "./insumoXrubroForm.php?id_rubro=" .$id_rubro. "&id=".$id_antiguo."&Bid_insumo=";
}

?>

<div class="encabezado">
    <h1><?php echo $titulo; ?></h1>
</div>

<!-- Lista -->
<article>
    <section class="formTop angosto">
        <form action="Buscar.php" method="get">
            <div class="table cien">
                <div class="row">
                    <span class="cell w75">
                        <input type="text" name="texto" value="<?php echo $texto ?>">
                    </span>
                    <span class="cell">
                        <input type="hidden" name="tipo" value="<?php echo $tipo;  ?>">
                        <input type="hidden" name="id_rubro" value="<?php echo $id_rubro; ?>">
                        <input type="hidden" name="id_obra" value="<?php echo $id_obra; ?>">
                        <input type="hidden" name="id" value="<?php echo $id_antiguo; ?>">
                        <input class="boton rojo submit" type="submit" name="guardar" value="BUSCAR">
                    </span>
                </div>
            </div>
        </form>
    </section>
    <?php if (isset($_GET['texto'])){ ?>
        <section class="listado">
                <?php
                $valores = consultaDb($consulta);
                if ($valores != 0){
                    echo '<ul class="listaLarga">';
                    foreach ($valores as $valor) {
                        $id = $valor['id'];
                        echo '<li><a href="'.$url. $id.'">'.$valor["nombre"].'</a></li>';
                    }
                    echo '</ul>';
                } else{
                    echo '<span class="mensaje">No se encontraron resultados para la búsqueda</span>';
                }
                ?>
        </section>
    <?php } ?>
</article>

<?php include('./footer.php');

/* Cerrar conexión ************************************************************/
mysqli_close($link)
?>
