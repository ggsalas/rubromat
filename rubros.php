<?php

$titulo = "Lista de Rubros";

include('./coneccionBd.php');
include('./header.php');

// Mensaje de acción realizada
if (isset($_GET['mensaje']) && $_GET['mensaje'] == "eliminado")
    echo "<div id=\"alerta\">Rubro eliminado</div>";
?>

<div class="encabezado">
    <div class="table cien">
        <div class="row ">
            <h1 class="cell"><?php echo $titulo; ?></h1>
            <span class="cell">
                <a href="./rubroForm.php" class="boton rojo rText" style="margin:0 0 8px 20px "><i class="material-icons">add</i>Agregar Rubro</a>
                <a href="./Buscar.php?tipo=rubro" class="boton rText"><i class="material-icons">search</i>Buscar</a>
            </span>
        </div>
    </div>
</div>

<!-- Lista de Rubroes -->
<article>
    <section class="listado">
        <ul class="listaLarga">
            <?php
            $consulta = "SELECT nombre, id from rubro ORDER BY nombre asc";
            $valores = consultaDb($consulta);

            foreach ($valores as $valor) {
                echo '<li><a href="./rubroForm.php?id='.$valor['id'].'">'.$valor["nombre"].'</a></li>';
            }
            ?>
        </ul>
    </section>
</article>

<?php include('./footer.php'); ?>
