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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Árbol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php require('inc/header.php'); ?>
    <div class="container my-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-success text-white text-center py-4">
                <h2 class="mb-0"><?php echo htmlspecialchars($tree['especie']); ?></h2>
                <p class="mb-0"><small>Nombre Científico: <?php echo htmlspecialchars($tree['nombre_cientifico']); ?></small></p>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Tamaño:</strong>
                        <span><?php echo htmlspecialchars($tree['tamaño']); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Ubicación Geográfica:</strong>
                        <span><?php echo htmlspecialchars($tree['ubicacion_geografica']); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Estado:</strong>
                        <span><?php echo htmlspecialchars($tree['estado']); ?></span>
                    </li>
                </ul>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="editDetails.php?id=<?php echo $treeId; ?>" class="btn btn-primary mx-2">Editar Árbol</a>
                <a href="seeFriends.php" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</body>

</html>
