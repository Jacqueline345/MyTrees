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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                                <a href="actions/detalles.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-info btn-sm mx-1">Detalles</a>
                                <a href="actions/delete.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-danger btn-sm mx-1">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
