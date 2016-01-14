<?php

$titulo = "Lista de Obras";
$bodyEstilos = "obras";

include('./coneccionBd.php');
include('./header.php');

// Mensaje de acción realizada
if (isset($_GET['mensaje']) && $_GET['mensaje'] == "eliminado")
    echo "<div id=\"alerta\">Obra eliminada</div>";
?>

<div class="encabezado">
    <h1><?php echo $titulo; ?></h1>
    <a href="./obraForm.php" class="boton rojo rText"><i class="material-icons">add</i>Agregar Obra</a>
</div>

<!-- Lista de Rubroes -->
<article>
    <section class="listado">
        <ul class="listaLarga">
            <?php

            $consulta = "SELECT id, nombre, descripcion from obra ORDER BY id desc";
            $valores = consultaDb($consulta);

            foreach ($valores as $valor) {
                echo '<li><a href="./obraForm.php?id='.$valor['id'].'">'.$valor["nombre"].'<span class="descripcion">'.$valor['descripcion'].'</span></a> </li>';
            }
            ?>
        </ul>
    </section>
</article>

<?php include('./footer.php'); ?>
