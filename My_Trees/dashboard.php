<?php
session_start();
if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success_message'];
        unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error_message'];
        unset($_SESSION['error_message']); ?>
    </div>
<?php endif;
require('utils/functionsAdmin.php');

// Obtener estadísticas
$friendsCount = getFriendsCount();
$treesAvailableCount = getAvailableTreesCount();
$treesSoldCount = getSoldTreesCount();

// Obtener las especies de árboles
$trees = getAllTrees();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php require('inc/header.php'); ?>
    <div class="container">
        <h1 class="my-4">Dashboard del Administrador</h1>

        <!-- Sección de estadísticas -->
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Amigos Registrados</h5>
                        <p class="card-text"><?php echo $friendsCount; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Árboles Disponibles</h5>
                        <p class="card-text"><?php echo $treesAvailableCount; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Árboles Vendidos</h5>
                        <p class="card-text"><?php echo $treesSoldCount; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón para añadir un nuevo árbol -->
        <div class="my-3">
            <a href="addTree.php" class="btn btn-primary">Agregar Nuevo Árbol</a>
        </div>

        <!-- Tabla de Árboles con Estado -->
        <div class="my-4">
            <h2>Listado de Árboles</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Especie</th>
                        <th>Nombre Científico</th>
                        <th>Tamaño</th>
                        <th>Ubicación Geográfica</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trees as $tree) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tree['especie']); ?></td>
                            <td><?php echo htmlspecialchars($tree['nombre_cientifico']); ?></td>
                            <td><?php echo htmlspecialchars($tree['tamaño']); ?></td>
                            <td><?php echo htmlspecialchars($tree['ubicacion_geografica']); ?></td>
                            <td><?php echo htmlspecialchars($tree['estado']); ?></td>
                            <td>
                                <a href="editTree.php?id=<?php echo $tree['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="actions/deleteTree?id=<?php echo $tree['id']; ?>" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este árbol?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>