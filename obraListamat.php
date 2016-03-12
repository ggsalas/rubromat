<?php
/**
 * Este formulario se utiliza para crear y editar Rubros
 */

// inicio las variables
$id = $_GET['id'];

// título de la página
$nombreObra = $_GET['nombre'];
$titulo = "Lista de materiales";
$bodyEstilos = "listaMat";

// requerimientos
include('./coneccionBd.php');
include('./header.php');

/**
 * Consulta datos de insumos
 * JOIN con insumoXrubro para mostrar *solo* los mat. que pertenecen al rubro
 * LEFT JOIN con tabla unMetrica: para tener nombres de unidades
 */
$consultaInsumos = "SELECT I.id, I.nombre, IX.id_rubro, IX.rendimiento, RX.cantidad, I.unComercial, I.unMetrica, I.cantComercial, M.unidad, UM.unidad as uMetrica
                    FROM insumo as I
                    JOIN insumoXrubro as IX ON IX.id_insumo = I.id
                    JOIN rubroXobra as RX ON RX.id_rubro = IX.id_rubro
                    LEFT JOIN unComercial as M ON M.id = I.unComercial
                    LEFT JOIN unMetrica as UM on UM.id = I.unMetrica
                    WHERE RX.id_obra = $id
                    ORDER BY I.nombre asc";
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
            <h1 class="cell">Materiales para: <a href="./obraForm.php?id=<?php echo $id; ?>" ><?php echo $nombreObra; ?></a></h1>
            <span class="cell">
                <a href="./materiales.csv" class="boton rojo rText" style="margin:0 0 8px 20px "><i class="material-icons">file_download</i>Descargar (CSV)</a>
                <a href="#"  onClick="window.print()" class="boton rText"><i class="material-icons">print</i>Imprimir</a>
            </span>
        </div>
    </div>
</div>

<article>
    <section class="listado">
        <div  class="table lineas cien">
            <div class="row cabecera" style="display:none">
                <span class="cell">
                    <span class="descripcion encabeazdo">Insumo</span>
                </span>
                <span class="cell">
                    <span class="descripcion encabeazdo">Cantidad</span>
                </span>
                <span class="cell">
                    <span class="descripcion encabeazdo">Unidad</span>
                </span>
            </div>


            <?php
            /**
             * Creo un nuevo array con los valores que necesito, y hago los cálculos:
             * Cantidad de materiales = Sumatoria (Rendimiento * Cantidad) / Unidad cantComercial
             */
            foreach ($valoresInsumos as $valor) {
                    $computoId = $valor['id'];
                    $computoNombre = $valor['nombre'];
                    $computoValor = $valor['rendimiento'] * $valor['cantidad'] / $valor['cantComercial'];
                    $unidad = $valor['unidad'];
                    $cantComercial = $valor{'cantComercial'};
                    $uMetrica = $valor['uMetrica'];

                    $items[] = array('id' => $computoId, 'nombre' => $computoNombre, 'computo' => $computoValor, 'unidad' => $unidad, 'cantComercial' => $cantComercial, 'uMetrica' => $uMetrica );
            }

            // Sumo los computos de ID iguales
            // Extraido de http://stackoverflow.com/a/14196320
            function reducir_array($a, $b) {
                isset($a[$b['id']]) ? $a[$b['id']]['computo'] += $b['computo'] : $a[$b['id']] = $b;
                return $a;
            }
            $sum = array_reduce($items, "reducir_array");

            // Imprimo la lista
            foreach ($sum as $resultado) {
                $equivalencia = $resultado['cantComercial'] != 1 ? 'de ' .$resultado['cantComercial']. ' ' .$resultado['uMetrica'] : '';
                echo '<div class="row">';
                    echo '<span class="cell cien">' .$resultado['nombre']. '</span>';
                    echo '<span class="cell noCortar" style="text-align:right">' . round($resultado['computo'] , 1). '</span>';
                    echo '<span class="cell noCortar">' .$resultado['unidad']. '</span>';
                    echo '<span class="cell noCortar">' .$equivalencia. '</span>';
                echo '</div>';
            }

            /**
             * Creación de archivo CSV
             * http://php.net/manual/es/function.fputcsv.php
             */

            $listaImprimir[] = array('Nombre', 'Cantidad', 'Unidad');
            foreach ($sum as $dato) {
                $equivalencia = $dato['cantComercial'] != 1 ? 'de ' .$dato['cantComercial']. ' ' .$dato['uMetrica'] : '';
                $impNombre = $dato['nombre'];
                $impComputo = round($dato['computo'] , 1);
                $impUnidad = $dato['unidad'] .' '. $equivalencia;
                $listaImprimir[] = array('nombre' => $impNombre, 'cantidad' => $impComputo, 'unidad' => $impUnidad);
            }

            $fp = fopen('materiales.csv', 'w');

            foreach ($listaImprimir as $campos) {
                fputcsv($fp, $campos);
            }

            fclose($fp);

            ?>
        </div>
    </section>
</article>

<?php include('./footer.php'); ?>
