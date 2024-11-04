<?php
session_start();
require('../utils/functionsAdmin.php');

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Asegura que el ID es un entero

    if (deleteTree($id)) {
        $_SESSION['success_message'] = "Árbol eliminado exitosamente.";
    } else {
        $_SESSION['error_message'] = "Error al eliminar el árbol. Inténtalo nuevamente.";
    }
} else {
    $_SESSION['error_message'] = "ID de árbol no especificado.";
}

header('Location: ../dashboard.php');
exit();