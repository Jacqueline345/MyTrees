<?php
session_start(); // Asegúrate de iniciar la sesión al comienzo del archivo
require('../utils/functions.php');
$conn = getConnection();

if ($_POST && isset($_REQUEST['nombre_comprador'])) {
    // Validar que el usuario esté autenticado y obtener el id_usuario de la sesión
    if (!isset($_SESSION['id'])) {
        header("Location: ../mis_compras.php"); // Redireccionar si no está autenticado
        exit();
    }

    // Obtener el id_usuario y opcionalmente el nombre_comprador desde la sesión
    $user['id'] = $_SESSION['id'];
    $user['name'] = $_SESSION['name'] ?? $_REQUEST['name'];

    // Resto de los datos desde el formulario
    $arbol['id'] = $_REQUEST['id'];
    $arbol['especie'] = $_REQUEST['especie'];
    $arbol['tamaño'] = $_REQUEST['tamaño'];
    $arbol['ubicacion_geografica'] = $_REQUEST['ubicacion_geografica'];
    $arbol['estado'] = $_REQUEST['estado'];
    $arbol['precio'] = $_REQUEST['precio'];
    $arbol['foto'] = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : null;

    // Llamar a saveCompras con los datos del árbol y el usuario actual
    if (saveCompras($arbol, $user)) {
        header("Location: ../mis_compras.php");
        exit();
    } else {
        header("Location: /?error=Invalid tree data");
    }
}
?>