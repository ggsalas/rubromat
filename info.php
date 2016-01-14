<?php
/**
 * Este formulario se utiliza para crear y editar insumos
 */

// título de la página
$titulo = "Información sobre RubroMAT";
$bodyEstilos = 'bodyTexto';

// requerimientos
include('./header.php');
?>

<div class="encabezado">
    <h1>RubroMAT, un programa que asiste en el cómputo de materiales</h1>
</div>

<article>
    <section class="texto">
        <p>El principio básico del cómputo y presupuesto de obras de arquitectura es el análisis de precios. En RubroMAT a este análisis le denominamos &quot;rubros&quot;.</p>
        <p>Los <strong>Rubros</strong> se componen de insumos y éstos a su vez de materiales y mano de obra. Cada rubro posee una unidad de medida (Unidad métrica) que se refiere a la forma en que se debe medir el rubro, por ejemplo: las mamposterías y revoques se miden en metro cuadrado, los encadenados en metros lineales, el Hormigón en metros cúbicos, etc.</p>
        <p>Un conjunto específico de Rubros se denomina <strong>Obra</strong>. Mediante la introducción de la cantidad de unidades métricas de cada Rubro, el programa puede calcular la cantidad de Insumos (materiales y mano de obra) para la obra indicada. La forma de hacerlo es:</p>
        <p><img src="img/eq1.svg" alt="eq1"></p>
        <p>Los <strong>Insumos</strong> poseen dos unidades: La <strong>unidad métrica</strong>, que se refiere a la manera en la cual se mide el material, y la <strong>unidad de comercial</strong> que se refiere a la unidad que se utiliza para la venta del material. A su vez, la unidad comercial requiere saber la cantidad mínima de venta, la cual llamamos <strong>cantidad comercial</strong>. Por ejemplo: el cemento se mide en kilos y se vende en la misma unidad pero la unidad mínima es la bolsa de 50Kg. Otro ejemplo son las varillas de acero para la construcción de hormigón armado: se miden en metros lineales pero se venden por unidad (varillas) que miden 12 metros lineales cada una.</p>
        <p>Para que el listado de materiales considere la unidad comercial la forma de calcularlos queda definida por:</p>
        <p><img src="img/eq2.svg" alt="eq2"></p>
        <h2 id="dise-o-del-programa">Diseño del programa</h2>
        <h3 id="php">PHP</h3>
        <p>Se priorizó la reutilización de código mediante el uso de <strong>include</strong> y de <strong>funciones</strong>. La estructura de las páginas es la siguiente:</p>
        <ul>
        <li>ESTRUCTURA<ul>
        <li><strong>header</strong>: encabezado</li>
        <li><strong>footer</strong>: pie de página</li>
        <li><strong>coneccionBd</strong>: conección a la base de datos</li>
        </ul>
        </li>
        <li>INSUMOS<ul>
        <li><strong>insumos</strong>: lista de insumos</li>
        <li><strong>insumoForm</strong>: formulario</li>
        <li><strong>insumoResultado</strong>: resultado del formulario (redirección a insumoForm)</li>
        </ul>
        </li>
        <li>RUBROS<ul>
        <li><strong>rubros</strong>: lista de rubros</li>
        <li><strong>rubroForm</strong>: formulario</li>
        <li><strong>rubroResultado</strong>: resultado del formulario (redirección a rubroForm)</li>
        </ul>
        </li>
        <li>OBRAS<ul>
        <li><strong>obras</strong>: lista de obras</li>
        <li><strong>obraForm</strong>: formulario</li>
        <li><strong>obraResultado</strong>: resultado del formulario (redirección a obraForm)</li>
        <li><strong>obraListamat</strong>: calcula la lista de materiales que requiere la obra indicada. Exporta la lista a fomrmato .csv mediante el archivo <strong>materiales.csv</strong>.</li>
        </ul>
        </li>
        <li>BUSCAR: mediante variables pasadas por GET y POST (según el caso) la página <strong>Buscar.php</strong> se utiliza para buscar:<ul>
        <li>Insumos y Rubros en general</li>
        <li>Insumos y Rubros a insertar en el formulario <strong>rubroForm</strong> y <strong>obraForm</strong>. Para esto el link de cada resultado inserta el insumo/rubro en el formulario correspondiente. A su vez filtra los insumos/rubros que ya tiene el rubro/obra cada elemento puede estar solo una vez. La ventaja de utilizar una búsqueda se hace notable cuando la cantidad de elementos del menú desplegable es grande.</li>
        </ul>
        </li>
        <li>OTRAS PAG:<ul>
        <li>Index</li>
        <li>Info</li>
        </ul>
        </li>
        </ul>
        <h3 id="dise-o-de-la-base-de-datos">Diseño de la base de datos</h3>
        <p>La base de datos comprende <strong>3 tablas principales</strong>: insumo, rubro y obra, y <strong>dos tablas accesorias</strong>: unCmercial y unMetrica que poseen la relación uno a muchos con las tablas principales correspondientes. A su vez, las tablas principales se relacionan entre ellas mediante la relación muchos a muchos para lo cual se crean las dos tablas accesorias: <strong>insumoXrubro y rubroXobra</strong>. El esquema del diseño de la base de datos queda definido en el siguiente gráfico:</p>
        <p><img src="img/esquemaBd.png" alt="esquema del dise&#xF1;o de la base de datos"></p>
        <p>Y el resultado de la implementación de este diseño es el siguiente:</p>
        <p><img src="img/estructuraBd.png" alt="Estructura de la base de datos"></p>
        <h3 id="dise-o-gr-fico-responsive">Diseño gráfico Responsive</h3>
        <p>El diseño de RubroMAT está inspirado en <a href="https://www.google.com/design/spec/material-design/introduction.html">Google Material Design</a>. y verifica el correcto uso del programa desde una pantalla de PC y una pantalla de celular. A modo de ejemplo:</p>
        <p><img src="img/responsive.png" alt="dise&#xF1;o responsive"></p>
        <p>Los íconos utiliados son los que provee Google material design y están instalados localmente, mientras que la tipografía elegida, Raleway, se carga con conexión a internet o en su defecto se utiliza una sans-serif que el dispositivo tenga instalada.</p>
    </section>

</article>

<?php include('./footer.php'); ?>
