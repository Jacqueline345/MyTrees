<?php
require('utils/functionsAdmin.php');

// Obtener amigos y los árboles que han comprado
$friendsWithTrees = getFriendsWithTrees();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amigos y Árboles Comprados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Contenedor principal -->
    <?php require('inc/header.php'); ?>
    <div class="container mt-4">
        <h2>Amigos Registrados y Árboles Comprados</h2>

        <!-- Tabla de amigos y árboles comprados -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre de Amigo</th>
                    <th>Árboles Comprados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($friendsWithTrees as $friendName => $trees) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($friendName); ?></td>
                        <td>
                            <ul>
                                <?php foreach ($trees as $tree) { ?>
                                    <li><?php echo htmlspecialchars($tree['especie'] . ' - ' . $tree['nombre_cientifico']); ?></li>
                                <?php } ?>
                            </ul>
                        </td>
                        <td>
                            <!-- Botón para abrir el modal de detalles -->
                            <button class="btn btn-success" data-toggle="modal" data-target="#detailsModal-<?php echo md5($friendName); ?>">
                                Ver Detalles
                            </button>
                        </td>
                    </tr>

                    <!-- Modal para mostrar los detalles de las compras -->
                    <div class="modal fade" id="detailsModal-<?php echo md5($friendName); ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?php echo md5($friendName); ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailsModalLabel-<?php echo md5($friendName); ?>">Detalles de las Compras de <?php echo htmlspecialchars($friendName); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        <?php foreach ($trees as $tree) { ?>
                                            <li><strong>Especie:</strong> <?php echo htmlspecialchars($tree['especie']); ?></li>
                                            <li><strong>Nombre Científico:</strong> <?php echo htmlspecialchars($tree['nombre_cientifico']); ?></li>
                                            <li><strong>Tamaño:</strong> <?php echo htmlspecialchars($tree['tamaño']); ?></li>
                                            <li><strong>Ubicación Geográfica:</strong> <?php echo htmlspecialchars($tree['ubicacion_geografica']); ?></li>
                                            <li><strong>Estado:</strong> <?php echo htmlspecialchars($tree['estado']); ?></li>
                                            <hr>
                                        <?php } ?>
                                    </ul>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>
