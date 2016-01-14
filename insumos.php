<?php

$titulo = "Lista de Insumos";

include('./coneccionBd.php');
include('./header.php');

// Mensaje de acción realizada
if (isset($_GET['mensaje']) && $_GET['mensaje'] == "eliminado")
    echo "<div id=\"alerta\">Insumo eliminado</div>";
else if (isset($_GET['mensaje']) && $_GET['mensaje'] == "actualizado")
    echo "<div id=\"alerta\">Insumo actualizado</div>";
?>

<div class="encabezado">
    <div class="table cien">
        <div class="row ">
            <h1 class="cell"><?php echo $titulo; ?></h1>
            <span class="cell">
                <a href="./insumoForm.php" class="boton rojo rText" style="margin:0 0 8px 20px "><i class="material-icons">add</i>Agregar Insumo</a>
                <a href="./Buscar.php?tipo=insumo" class="boton rText"><i class="material-icons">search</i>Buscar</a>
            </span>
        </div>
    </div>
</div>

<!-- Lista de Insumoes -->
<article>
    <section class="listado">
        <ul class="listaLarga">
            <?php
            $consulta = "SELECT nombre, id from insumo ORDER BY nombre asc";
            $valores = consultaDb($consulta);

            foreach ($valores as $valor) {
                echo '<li><a href="./insumoForm.php?id='.$valor['id'].'">'.$valor["nombre"].'</a></li>';
            }
            ?>
        </ul>
    </section>
</article>

<?php include('./footer.php'); ?>
