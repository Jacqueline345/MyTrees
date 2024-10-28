<?php
session_start();
require('utils/functionsAdmin.php');

// Obtener estadísticas
$friendsCount = getFriendsCount();
$treesAvailableCount = getAvailableTreesCount();
$treesSoldCount = getSoldTreesCount();

// Obtener las especies de árboles
$treesByStatus = getTreesByStatus();
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
                <div class="card bg-primary text-white">
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

        <!-- Tabla de Árboles por Estado -->
        <div class="my-4">
            <h2>Listado de Árboles</h2>

            <h3>Árboles Disponibles</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Especie</th>
                        <th>Nombre Científico</th>
                        <th>Tamaño</th>
                        <th>Ubicación Geográfica</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($treesByStatus['disponible'] as $tree) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tree['especie']); ?></td>
                            <td><?php echo htmlspecialchars($tree['nombre_cientifico']); ?></td>
                            <td><?php echo htmlspecialchars($tree['tamaño']); ?></td>
                            <td><?php echo htmlspecialchars($tree['ubicacion_geografica']); ?></td>
                            <td>
                                <a href="editTree.php?id=<?php echo $tree['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="delete_tree.php?id=<?php echo $tree['id']; ?>" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este árbol?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h3>Árboles Vendidos</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Especie</th>
                        <th>Nombre Científico</th>
                        <th>Tamaño</th>
                        <th>Ubicación Geográfica</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($treesByStatus['vendido'] as $tree) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tree['especie']); ?></td>
                            <td><?php echo htmlspecialchars(string: $tree['nombre_cientifico']); ?></td>
                            <td><?php echo htmlspecialchars($tree['tamaño']); ?></td>
                            <td><?php echo htmlspecialchars($tree['ubicacion_geografica']); ?></td>
                            <td>
                                <a href="editTree.php?id=<?php echo $tree['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="delete_tree.php?id=<?php echo $tree['id']; ?>" class="btn btn-danger"
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