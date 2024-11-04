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
    <?php require('inc/headerAdmin.php'); ?>
    <div class="container mt-4">
        <h2>Amigos Registrados y Árboles Comprados</h2>

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
                                    <li><?php echo htmlspecialchars($tree['especie'] . ' - ' . $tree['nombre_cientifico']); ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </td>
                        <td>
                            <button class="btn btn-success" data-toggle="modal"
                                data-target="#detailsModal-<?php echo md5($friendName); ?>">
                                Ver Detalles
                            </button>
                        </td>
                    </tr>

                    <!-- Modal de Detalles -->
                    <div class="modal fade" id="detailsModal-<?php echo md5($friendName); ?>" tabindex="-1" role="dialog"
                        aria-labelledby="detailsModalLabel-<?php echo md5($friendName); ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailsModalLabel-<?php echo md5($friendName); ?>">Detalles
                                        de las Compras de <?php echo htmlspecialchars($friendName); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        <?php foreach ($trees as $tree) { ?>
                                            <li><strong>Especie:</strong> <?php echo htmlspecialchars($tree['especie']); ?></li>
                                            <li><strong>Nombre Científico:</strong>
                                                <?php echo htmlspecialchars($tree['nombre_cientifico']); ?></li>
                                            <li><strong>Tamaño:</strong> <?php echo htmlspecialchars($tree['tamaño']); ?></li>
                                            <li><strong>Ubicación Geográfica:</strong>
                                                <?php echo htmlspecialchars($tree['ubicacion_geografica']); ?></li>
                                            <li><strong>Estado:</strong> <?php echo htmlspecialchars($tree['estado']); ?></li>
                                            <li><strong>Precio:</strong> <?php echo htmlspecialchars($tree['precio']); ?></li>

                                            <hr>

                                            <!-- Botón para abrir el modal de edición -->
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#editModal-<?php echo $tree['id']; ?>">
                                                Editar
                                            </button>
                                            <hr>

                                            <!-- Modal de Edición -->
                                            <div class="modal fade" id="editModal-<?php echo $tree['id']; ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel-<?php echo $tree['id']; ?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editModalLabel-<?php echo $tree['id']; ?>">Editar Árbol</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="actions/editTree.php" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo htmlspecialchars($tree['id']); ?>">
                                                                <div class="form-group">
                                                                    <label>Especie</label>
                                                                    <input type="text" class="form-control" name="especie"
                                                                        value="<?php echo htmlspecialchars($tree['especie']); ?>"
                                                                        readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nombre Científico</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nombre_cientifico"
                                                                        value="<?php echo htmlspecialchars($tree['nombre_cientifico']); ?>"
                                                                        readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Tamaño</label>
                                                                    <input type="text" class="form-control" name="tamaño"
                                                                        value="<?php echo htmlspecialchars($tree['tamaño']); ?>"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Ubicación Geográfica</label>
                                                                    <input type="text" class="form-control"
                                                                        name="ubicacion_geografica"
                                                                        value="<?php echo htmlspecialchars($tree['ubicacion_geografica']); ?>"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Estado</label>
                                                                    <input type="text" class="form-control"
                                                                        name="estado"
                                                                        value="<?php echo htmlspecialchars($tree['estado']); ?>"
                                                                        readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Precio</label>
                                                                    <input type="text" class="form-control"
                                                                        name="precio"
                                                                        value="<?php echo htmlspecialchars($tree['precio']); ?>"
                                                                        required>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary">Guardar
                                                                    Cambios</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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