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


?>
