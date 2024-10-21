<?php
require('../utils/functions.php');

function validaLoginInput($username, $password) {
    if (empty($username) || empty($password)) {
        return false; // Si alguno está vacío, devuelve falso
    }
    return true; // Ambos están completos
}

if ($_POST) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    // Llama a la función de validación
    if (!validaLoginInput($username, $password)) {
        header('Location: index.php?error=empty_fields');
        exit();
    }

    $user = authenticate($username, $password);

    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: ../trees.php');
    } else {
        header('Location: index.php?error=login');
    }
}
