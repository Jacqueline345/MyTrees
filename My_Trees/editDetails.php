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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Árbol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php require('inc/header.php'); ?>
    <div class="container my-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <h2 class="mb-0">Editar Árbol</h2>
            </div>
            <div class="card-body">
                <form action="actions/editTree.php" method="post">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($tree['id']); ?>">
                    
                    <div class="form-group">
                        <label for="especie">Especie</label>
                        <input type="text" class="form-control" name="especie" value="<?php echo htmlspecialchars($tree['especie']); ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombre_cientifico">Nombre Científico</label>
                        <input type="text" class="form-control" name="nombre_cientifico" value="<?php echo htmlspecialchars($tree['nombre_cientifico']); ?>" readonly>
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
                    
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Actualizar Árbol</button>
                        <a href="seeFriends.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
