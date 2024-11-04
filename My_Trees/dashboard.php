<?php
session_start();
if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['success_message'];
        unset($_SESSION['success_message']); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['error_message'];
        unset($_SESSION['error_message']); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php require('inc/headerAdmin.php'); ?>
    <div class="container my-5">
        <h1 class="text-center mb-4">Dashboard del Administrador</h1>

        <!-- Sección de estadísticas -->
        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <a href="seeFriends.php" class="card bg-info text-white shadow-sm text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Amigos Registrados</h5>
                        <p class="card-text display-4"><?php echo $friendsCount; ?></p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Árboles Disponibles</h5>
                        <p class="card-text display-4"><?php echo $treesAvailableCount; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-danger text-white shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Árboles Vendidos</h5>
                        <p class="card-text display-4"><?php echo $treesSoldCount; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón para añadir un nuevo árbol -->
        <div class="text-center my-4">
            <a href="addTree.php" class="btn btn-primary btn-lg">Agregar Nuevo Árbol</a>
        </div>

        <!-- Tabla de Árboles con Estado -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Listado de Árboles Disponibles</h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover m-0">
                    <thead class="thead-dark">
                        <tr>
                            <td><?php echo htmlspecialchars($tree['especie']); ?></td>
                            <td><?php echo htmlspecialchars($tree['nombre_cientifico']); ?></td>
                            <td><?php echo htmlspecialchars($tree['tamaño']); ?></td>
                            <td><?php echo htmlspecialchars($tree['ubicacion_geografica']); ?></td>
                            <td><?php echo htmlspecialchars($tree['estado']); ?></td>
                            <td><?php echo htmlspecialchars($tree['foto']); ?></td>
                            <td>

                                <a href="editTree.php?id=<?php echo $tree['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="actions/deleteTree.php?id=<?php echo $tree['id']; ?>" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar este árbol?');">Eliminar</a>
                            </td>
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
                                    <a href="editTree.php?id=<?php echo $tree['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="actions/deleteTree.php?id=<?php echo $tree['id']; ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('¿Estás seguro de eliminar este árbol?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
