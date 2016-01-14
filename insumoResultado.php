<?php

include('./coneccionBd.php');

// Tomo las variables por POST
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$unMetrica = $_POST['unMetrica'];
$unComercial = $_POST['unComercial'];
$cantComercial = $_POST['cantComercial'];
$sql = "";

/**
 * Verifico la acción y Decido que hacer
 */
$accion = $_POST['accion'];

if (isset($_POST['guardar'])){
    // URL a Redireccionar
    $url = './insumos.php?id=' . $id . '&mensaje=actualizado'; // Si estoy creando un nuevo rubro debo consultar la ID :(

    if ($accion == "crear"){

        // Nuevo registro
        $sql = "INSERT INTO insumo(nombre, unMetrica, unComercial, cantComercial)
                VALUES ('$nombre', $unMetrica, $unComercial, $cantComercial)";
    }
    else if ($accion == "editar"){
        // Edito
        $sql = "UPDATE insumo
                SET nombre = '$nombre', unMetrica= $unMetrica, unComercial = $unComercial, cantComercial = $cantComercial
                WHERE id = $id";
    }
}
else if (isset($_POST['borrar'])){
    // Borro el registro
    $sql = "DELETE FROM insumo WHERE id = $id ";

    // URL a Redireccionar
    $url = './insumos.php?mensaje=eliminado';
}

/**
 * Realizar la acción
 */
$res = mysqli_query($link, $sql);

// Cerrar Mysql
@mysqli_close($link);

/**
 * Redireccionar
 */
// Variables a pasar
$mensaje = "actualizado";

header('Location: ' . $url );
die();

?>
