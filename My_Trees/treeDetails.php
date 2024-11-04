<?php
require('utils/functionsAdmin.php');

// Obtener el árbol por ID
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
    <title>Detalles del Árbol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php require('inc/header.php'); ?>
    <div class="container mt-4">
        <h2 class="mb-4">Detalles del Árbol</h2>
        <div class="card">
            <div class="card-header">
                <h5><?php echo htmlspecialchars($tree['especie']); ?></h5>
                <small class="text-muted">Nombre Científico: <?php echo htmlspecialchars($tree['nombre_cientifico']); ?></small>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Tamaño:</strong> <?php echo htmlspecialchars($tree['tamaño']); ?></li>
                    <li class="list-group-item"><strong>Ubicación Geográfica:</strong> <?php echo htmlspecialchars($tree['ubicacion_geografica']); ?></li>
                    <li class="list-group-item"><strong>Estado:</strong> <?php echo htmlspecialchars($tree['estado']); ?></li>
                </ul>
            </div>
            <div class="card-footer text-right">
                <a href="editDetails.php?id=<?php echo $treeId; ?>" class="btn btn-primary">Editar Árbol</a>
                <a href="seeFriends.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</body>

</html>
