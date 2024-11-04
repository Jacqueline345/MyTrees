<?php
session_start();
require('utils/functionsAdmin.php');

if ($_POST) {
    $especie = $_POST['especie'];
    $nombre_cientifico = $_POST['nombre_cientifico'];
    $tamaño = $_POST['tamaño'];
    $ubicacion_geografica = $_POST['ubicacion_geografica'];
    $estado = $_POST['estado'];
    $precio = $_POST['precio'];

    if (addTree($especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado, $precio)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Error al agregar el árbol. Inténtalo nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Árbol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Agregar Nuevo Árbol</h1>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
        <form method="POST" action="addTree.php">
            <div class="form-group">
                <label>Especie:</label>
                <input type="text" name="especie" required class="form-control">
            </div>
            <div class="form-group">
                <label>Nombre Científico:</label>
                <input type="text" name="nombre_cientifico" required class="form-control">
            </div>
            <div class="form-group">
                <label>Tamaño:</label>
                <input type="text" name="tamaño" required class="form-control">
            </div>
            <div class="form-group">
                <label>Ubicación Geográfica:</label>
                <input type="text" name="ubicacion_geografica" required class="form-control">
            </div>
            <div class="form-group">
                <label>Precio:</label>
                <input type="text" name="precio" required class="form-control">
            </div>
            <div class="form-group">
                <label>Estado:</label>
                <select name="estado" required class="form-control">
                    <option value="disponible">Disponible</option>
                    <option value="vendido">Vendido</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Árbol</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
