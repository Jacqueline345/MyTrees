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

    // Verificación de campos vacíos
    if (!validaLoginInput($username, $password)) {
        header('Location: index.php?error=empty_fields');
        exit();
    }

    // Primero, intenta autenticar como usuario 'amigo'
    $user = authenticate($username, $password, 'amigo');

    // Si no está en usuarios, intenta autenticar como admin
    if (!$user) {
        $user = authenticate($username, $password, 'admin');
        if ($user) {
            $user['role'] = 'admin';
        }
    }

    if ($user) {
        session_start();
        $_SESSION['user'] = $user;

        // Redirección según el rol
        if ($user['role'] === 'admin') {
            header('Location: ../dashboard.php'); 
        } else {
            header('Location: ../trees.php'); 
        }
    } else {
        header('Location: index.php?error=login');
    }
}
