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
    // Manejo de la carga de la imagen
    $foto = $_FILES['foto'];
    $fotoPath = null;

    // Verificar si se subió una nueva imagen
    if ($foto['error'] === UPLOAD_ERR_OK) {
        // Verifica el tipo de archivo (opcional, dependiendo de tus requisitos)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($foto['type'], $allowedTypes)) {
            $uploadDir = '..uploads/';
            $fotoPath = $uploadDir . basename($foto['name']);
            // Mover el archivo a la carpeta de uploads
            if (move_uploaded_file($foto['tmp_name'], $fotoPath)) {
                // Actualizar la base de datos con la nueva ruta de la foto
                if (updateTree($id, $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado, $precio, $fotoPath)) {
                    header('Location: ../dashboard.php'); // Redirige al dashboard después de la actualización
                    exit();
                } else {
                    echo "Error al actualizar el árbol.";
                }
            } else {
                echo "Error al mover el archivo subido.";
            }
        } else {
            echo "Tipo de archivo no permitido.";
        }
    } else {
        // Si no se subió una nueva imagen, solo actualizamos los demás campos
        if (updateTree($id, $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado, $precio)) {
            header('Location: ../dashboard.php'); // Redirige al dashboard después de la actualización
            exit();
        } else {
            echo "Error al actualizar el árbol.";
        }
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
