<?php

$titulo = "RubroMat";
$bodyEstilos = "bodyPortada";
include('./header.php');

?>

<!-- <div class="encabezado">
    <h1><?php echo $titulo; ?></h1>
</div> -->

<!-- Home -->
<article>
    <section class="portada">
        <span class="texto">
            RUBRO<b>MAT</b>
            <p>
                Cómputo de materiales
            </p>
            <span><a href="#presentacion"><i class="material-icons">arrow_downward</i></a></span>
        </span>
    </section>
    <section id="presentacion" name="presentacion">
        <div class="table cien marco">
            <div class="row">
                <span class="cell w33">
                    <i class="material-icons">home</i>
                    <h3>Creá una obra</h3>
                    <p>
                        No importa la escala, puede ser tan pequeña o tan grande como necesites.
                    </p>
                </span>
                <span class="cell w33">
                    <i class="material-icons">add_circle_outline</i>
                    <h3>Agregá rubros</h3>
                    <p>
                        Buscá en todos los rubros que tenemos o creá los tuyos (desde "configuración")
                    </p>
                </span>
                <span class="cell w33">
                    <i class="material-icons">list</i>
                    <h3>Obtené materiales</h3>
                    <p>
                        Obtené la lista de materiales. Lista para imprimir o exportar a Excel.
                    </p>
                </span>
            </div>
        </div>
    </section>
    <div id="accion">
        <div class="blur">
            <span class="marco">
                <p>
                    Descubrí el funcionamiento mirando algunas de las <a href="./obras.php">obras creadas</a>
                </p>
                <a href="./obraForm.php" class="boton rojo grande">Creá tu primera obra</a>
            </span>
        </div>
    </div>
    <a id="info" href="./info.php">
        <span class="marco">
                <i class="material-icons">info</i>
                Información sobre el funcionamiento de este programa.
        </span>
    </a>

</article>

<?php include('./footer.php'); ?>
