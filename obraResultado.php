<?php

include('./coneccionBd.php');
include('./header.php');

// Tomo las variables por POST
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$sql = "";

// Verifico la acción
$accion = $_POST['accion'];

// Si se presionó el botón "guardar"
if (isset($_POST['guardar'])){
    // URL a Redireccionar
    $url = './obraForm.php?id=' . $id . '&mensaje=actualizado'; // Si estoy creando un nuevo rubro debo consultar la ID :(

    if ($accion == "crear"){
        // Nuevo registro
        $sql = "INSERT INTO obra(nombre, descripcion)
                VALUES ('$nombre', '$descripcion')";
    }
    else if ($accion == "editar"){
        $id = $_POST['id'];
        // Edito
        $sql = "UPDATE obra
                SET nombre = '$nombre', descripcion = '$descripcion'
                WHERE id = $id";
    }
}
// Si se presionó el botón "borrar"
else if (isset($_POST['borrar'])){
    // Borro el registro
    $sql = "DELETE FROM obra WHERE id = $id ";

    // URL a Redireccionar
    $url = './obras.php?mensaje=eliminado';
}

$res = mysqli_query($link, $sql);
@mysqli_close($link);


/**
 * Redireccionar
 */
// Variables a pasar
$mensaje = "actualizado";

header('Location: ' . $url );
die();

?>
