<?php
require('../utils/functions.php');
if ($_POST && isset($_REQUEST['nombre_comprador'])) {
    $arbol['nombre_comprador'] = $_REQUEST['nombre_comprador'];
    $arbol['especie'] = $_REQUEST['especie'];
    $arbol['tamaño'] = $_REQUEST['tamaño'];
    $arbol['ubicacion_geografica'] = $_REQUEST['ubicacion_geografica'];
    $arbol['estado'] = $_REQUEST['estado'];
    $arbol['precio'] = $_REQUEST['precio'];
    $arbol['foto'] = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : null;

    if (UpdateArbol($arbol)) {
        echo "Este arbol se vendio con exito";
    } else {
        header("Location: /?error=Invalid shopping");
    }
    if (saveCompras($arbol)) {
        header("Location: mis_compras.php");
    } else {
        header("Location: /?error=Invalid tree data");
    }
}
?>