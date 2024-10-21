<?php
require('../utils/functions.php');
if ($_POST && isset($_REQUEST['id'])) {
    $nombre_comprador['nombre_comprador'] = $_REQUEST['nombre_comprador'];
    $arbol['especie'] = $_REQUEST['especie'];
    $arbol['tamaño'] = $_REQUEST['tamaño'];
    $arbol['ubicacion_geografica'] = $_REQUEST['ubicacion_geografica'];
    $arbol['estado'] = $_REQUEST['estado'];
    $arbol['precio'] = $_REQUEST['precio'];
    $arbol['foto'] = $_REQUEST['foto'];

    if (saveCompras($arbol)) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $arbol_id = $_POST['id'];
            $update_query = "UPDATE arboles SET estado = 'Vendido' WHERE id = $id";
            mysqli_query($conn, $update_query);
            header("Location: ../mis_compras.php");
        } else {
            header("Location: /?error=Invalid user data");
        }
    }
}

?>