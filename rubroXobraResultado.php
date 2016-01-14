<?php

include('./coneccionBd.php');
include('./header.php');

// Tomo las variables por POST
$id_rubro = $_POST['id_rubro'];
$id_antiguo = $_POST['id'];
$id_obra = $_POST['id_obra'];
$cantidad = $_POST['cantidad'];
$sql = "";

// Verifico la acción
$accion = $_POST['accion'];

// Si se presionó el botón "guardar"
if (isset($_POST['guardar'])){
    // URL a Redireccionar
    $url = './obraForm.php?id=' . $id_obra . '&mensaje=actualizado';

    if ($accion == "crear"){
        // Nuevo registro
        $sql = "INSERT INTO rubroXobra(id_obra, id_rubro, cantidad)
                VALUES ($id_obra, $id_rubro, $cantidad)";
    }
    else if ($accion == "editar"){
        // Edito
        $sql = "UPDATE rubroXobra
                SET cantidad = $cantidad, id_rubro = $id_rubro
                WHERE id_rubro = $id_antiguo AND id_obra = $id_obra";
    }
}
// Si se presionó el botón "borrar"
else if (isset($_POST['borrar'])){
    // Borro el registro
    $sql = "DELETE FROM rubroXobra WHERE id_obra = $id_obra AND id_rubro = $id_rubro";

    // URL a Redireccionar
    $url = './obraForm.php?id=' . $id_obra . '&mensaje=eliminado';
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
