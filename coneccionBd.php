<?php
/**
 * Conectar a la base de datos del programa RubroMAT
 ******************************************************************************/
define('server', "localhost");
define('usuario', "root");
define('clave', "root");
define('basededatos', "rubroMat");
// Para utilizarse en otras páginas
$baseDeDatos = 'rubroMat';

$link = mysqli_connect (server, usuario, clave, basededatos);

// control de errores
if  (mysqli_connect_error()){
    die("error al conectar");
}

/**
 * Funciones para consultas a la base de datos
 */
function consultaDb($consulta){
    // Traigo la variable $link
    global $link;

    // El resultado de la consulta
    $result = mysqli_query($link, $consulta);

    // Mientras mysqli_fetch_array le pueda asignar su valor a $row ...
    // De esta manera paso el resultado de la consulta a un array
    $resultado ="";
    while ($row = mysqli_fetch_array($result)){
        $resultado[] = $row;
    }

    // La función devuelve el array con el resultado de la consulta
    return $resultado;
}

/**
 * Otras funciones útiles
 */

// Nombre de página en insumoXrubro y rubroXobra 
function tituloNombre($dbTable, $id, $un){
    if ($un == 1) 
      $unidadMetrica = ", unMetrica";
    else
      $unidadMetrica = "";

    // Datos para el título de la página
    $sqlNombre =   "SELECT nombre $unidadMetrica 
                    from $dbTable WHERE id = $id"; 
      
    $valoresNombre = consultaDb($sqlNombre);
    foreach ($valoresNombre as $nombre){
        $nombre[] = $nombre;
    }

    // Busco el nombre de la unidad métrica
    if ($un == 1){
        $idUnidad =  $nombre['unMetrica'];
        $sqlUnidad = "SELECT unidad from unMetrica WHERE id = $idUnidad";
        $valoresUnidad = consultaDb($sqlUnidad);
        foreach ($valoresUnidad as $unidad){
            $unidad[] = $unidad;
        }

        return  $nombre['nombre'] . " [" . $unidad['unidad'] . "]";
    } else {
        return  $nombre['nombre'];
    }

}


?>
