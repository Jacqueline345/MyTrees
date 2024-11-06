<?php
require('utils/functions.php');
$conn = getConnection();
$sql = "SELECT * FROM mis_compras";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras</title>
    <!-- Incluye CSS de Boostrap para añadir estilo-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Incluye jQuery y JavaScript de Boostrap para hacer el modal más interactivo y ayudar a la experiencia de usuario-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <?php require('inc/header.php') ?>
    <div class="container my-5">
        <div class="jumbotron bg-light shadow-sm">
            <h1 class="display-5 text-center">Mis Compras</h1>
            <p class="lead text-center">Lista de todas las compras realizadas</p>
            <hr class="my-4">
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Comprador</th>
                        <th>Especie</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre_comprador']); ?></td>
                            <td><?php echo htmlspecialchars($row['especie']); ?></td>
                            <td>
                                <!-- Botón para abrir el modal -->
                                <button class="btn btn-info btn-sm mx-1" data-toggle="modal" data-target="#detailsModal<?php echo $row['id']; ?>">Detalles</button>
                                <a href="actions/delete.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-danger btn-sm mx-1">Eliminar</a>
                            </td>
                        </tr>

                        <!-- Modal de detalles -->
                        <div class="modal fade" id="detailsModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title" id="detailsModalLabel<?php echo $row['id']; ?>">Detalles del Árbol</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>ID:</strong> <?php echo htmlspecialchars($row['id']); ?></p>
                                        <p><strong>Nombre del Comprador:</strong> <?php echo htmlspecialchars($row['nombre_comprador']); ?></p>
                                        <p><strong>Especie:</strong> <?php echo htmlspecialchars($row['especie']); ?></p>
                                        <p><strong>Tamaño:</strong> <?php echo htmlspecialchars($row['tamaño']); ?></p>
                                        <p><strong>Ubicación Geográfica:</strong> <?php echo htmlspecialchars($row['ubicacion_geografica']); ?></p>
                                        <p><strong>Estado:</strong> <?php echo htmlspecialchars($row['estado']); ?></p>
                                        <p><strong>Precio:</strong> $<?php echo htmlspecialchars($row['precio']); ?></p>
                                        <?php if (!empty($row['foto'])) { ?>
                                            <div class="text-center">
                                                <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto del árbol" class="img-fluid img-thumbnail" style="max-width: 300px;">
                                            </div>
                                        <?php } else { ?>
                                            <p class="text-muted">No hay imagen disponible</p>
                                        <?php } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
