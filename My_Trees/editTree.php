<?php
session_start();
require('utils/functionsAdmin.php');

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Árbol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <?php require('inc/headerAdmin.php'); ?>
    <div class="container">
        <h1>Editar Árbol</h1>
        <form action="actions/editTree.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($tree['id']); ?>">
            <div class="form-group">
                <label for="especie">Especie</label>
                <input type="text" class="form-control" name="especie" value="<?php echo htmlspecialchars($tree['especie']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nombre_cientifico">Nombre Científico</label>
                <input type="text" class="form-control" name="nombre_cientifico" value="<?php echo htmlspecialchars($tree['nombre_cientifico']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tamaño">Tamaño</label>
                <input type="text" class="form-control" name="tamaño" value="<?php echo htmlspecialchars($tree['tamaño']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ubicacion_geografica">Ubicación Geográfica</label>
                <input type="text" class="form-control" name="ubicacion_geografica" value="<?php echo htmlspecialchars($tree['ubicacion_geografica']); ?>" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control" name="estado" required>
                    <option value="Disponible" <?php echo $tree['estado'] === 'Disponible' ? 'selected' : ''; ?>>Disponible</option>
                    <option value="Vendido" <?php echo $tree['estado'] === 'Vendido' ? 'selected' : ''; ?>>Vendido</option>
                </select>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="text" class="form-control" name="precio" value="<?php echo htmlspecialchars($tree['precio']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Árbol</button>
        </form>
    </div>
</body>
</html>
