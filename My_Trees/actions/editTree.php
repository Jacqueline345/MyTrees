<?php
session_start();
require('../utils/functionsAdmin.php'); // Asegúrate de que este archivo tenga la función getConnection() y otras necesarias

if ($_POST) {
    // Obtener los detalles del árbol del formulario
    $id = $_POST['id'];
    $especie = $_POST['especie'];
    $nombre_cientifico = $_POST['nombre_cientifico'];
    $tamaño = $_POST['tamaño'];
    $ubicacion_geografica = $_POST['ubicacion_geografica'];
    $estado = $_POST['estado']; // Agregando el estado
    $precio = $_POST['precio'];
    // Aquí debes implementar la función para actualizar el árbol
    if (updateTree($id, $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado, $precio)) {
        header('Location: ../dashboard.php'); // Redirige al dashboard después de la actualización
    } else {
        echo "Error al actualizar el árbol.";
    }
}

// Obtener el árbol a editar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $treeId = $_GET['id'];
    $tree = getTreeById($treeId);
    if (!$tree) {
        echo "Árbol no encontrado.";
        exit();
    }
} else {
    echo "ID inválido.";
    exit();
}
