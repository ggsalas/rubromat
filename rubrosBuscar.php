<?php

$titulo = "Buscar rubros";

include('./coneccionBd.php');
include('./header.php');

// Variable a tomar por GET (por la misma página)
$texto = $_GET['texto'];
?>

<div class="encabezado">
    <h1><?php echo $titulo; ?></h1>
    <a href="./rubroForm.php" class="boton rojo rText"><i class="material-icons">add</i>Agregar Rubro</a>
</div>

<!-- Lista de Rubroes -->
<article>
    <section class="listado">
        <ul class="listaLarga">
            <?php
            $consulta = "SELECT nombre, id from rubro ORDER BY id desc";
            $valores = consultaDb($consulta);

            foreach ($valores as $valor) {
                echo '<li><a href="./rubroForm.php?id='.$valor['id'].'">'.$valor["nombre"].'</a></li>';
            }
            ?>
        </ul>
    </section>
</article>

<?php include('./footer.php'); ?>
