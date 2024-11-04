<?php
session_start(); // Asegúrate de iniciar la sesión al comienzo del archivo
require('../utils/functions.php');
$conn = getConnection();

if ($_POST && isset($_REQUEST['nombre_comprador'])) {
    $arbol['nombre_comprador'] = $_REQUEST['nombre_comprador'];
    $arbol['especie'] = $_REQUEST['especie'];
    $arbol['tamaño'] = $_REQUEST['tamaño'];
    $arbol['ubicacion_geografica'] = $_REQUEST['ubicacion_geografica'];
    $arbol['estado'] = $_REQUEST['estado'];
    $arbol['precio'] = $_REQUEST['precio'];
    $arbol['foto'] = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : null;

    // Llamar a saveCompras con los datos del árbol y el usuario actual
    if (saveCompras($arbol)) {
        header("Location: ../mis_compras.php");
        exit();
    } else {
        header("Location: /?error=Invalid tree data");
    }
}
?>