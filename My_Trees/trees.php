<?php
require('utils/functions.php');
$conn = getConnection();
$sql = "SELECT * FROM arboles WHERE `estado` = 'disponible'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de los árboles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php require('inc/header.php') ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Árboles Disponibles</h1>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Especie</th>
                        <th>Tamaño</th>
                        <th>Ubicación Geográfica</th>
                        <th>Estado</th>
                        <th>Precio</th>
                        <th>Foto del Árbol</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['especie']); ?></td>
                            <td><?php echo htmlspecialchars($row['tamaño']); ?></td>
                            <td><?php echo htmlspecialchars($row['ubicacion_geografica']); ?></td>
                            <td><?php echo htmlspecialchars($row['estado']); ?></td>
                            <td>$<?php echo htmlspecialchars(number_format($row['precio'], 2)); ?></td>
                            <td>
                                <?php if ($row['foto']) { ?>
                                    <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto del árbol"
                                         class="img-fluid" style="max-width: 80px; height: auto;">
                                <?php } else { ?>
                                    <span class="text-muted">No disponible</span>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="compra.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-success btn-sm">
                                    Comprar
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
