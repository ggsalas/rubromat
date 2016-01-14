<?php

include('./coneccionBd.php');
include('./header.php');

// Tomo las variables por POST
$id_insumo = $_POST['id_insumo'];
$id_antiguo = $_POST['id'];
$id_rubro = $_POST['id_rubro'];
$rendimiento = $_POST['rendimiento'];
$sql = "";

// Verifico la acción
$accion = $_POST['accion'];

// Si se presionó el botón "guardar"
if (isset($_POST['guardar'])){
    // URL a Redireccionar
    $url = './rubroForm.php?id=' . $id_rubro . '&mensaje=actualizado';

    if ($accion == "crear"){
        // Nuevo registro
        $sql = "INSERT INTO insumoXrubro(id_rubro, id_insumo, rendimiento)
                VALUES ($id_rubro, $id_insumo, $rendimiento)";
    }
    else if ($accion == "editar"){
        // Edito
        $sql = "UPDATE insumoXrubro
                SET rendimiento = $rendimiento, id_insumo = $id_insumo
                WHERE id_insumo = $id_antiguo AND id_rubro = $id_rubro
                ";
        // $sql = "UPDATE insumoXrubro
        //         SET id_insumo = $id_insumo, rendimiento = $rendimiento
        //         WHERE id_rubro = $id_rubro AND id_insumo = $id_insumo";
    }
}
// Si se presionó el botón "borrar"
else if (isset($_POST['borrar'])){
    // Borro el registro
    $sql = "DELETE FROM insumoXrubro WHERE id_rubro = $id_rubro AND id_insumo = $id_insumo";

    // URL a Redireccionar
    $url = './rubroForm.php?id=' . $id_rubro . '&mensaje=eliminado';
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
