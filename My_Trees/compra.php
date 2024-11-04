<?php
include('utils/functions.php');
$conn = getConnection();
$users = getUser();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sql = "SELECT id, especie, tamaño, ubicacion_geografica, estado, precio, foto FROM arboles WHERE id= ?";
    $result = $conn->prepare($sql);
    $result->bind_param("i", $id);
    $result->execute();
    $result = $result->get_result();
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Árboles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php require('inc/header.php') ?>

    <div class="container my-5">
        <div class="jumbotron text-center bg-success text-white">
            <h1 class="display-4">Compra de Árboles</h1>
            <p class="lead">Si deseas comprar, actualiza la información y luego completa la compra.</p>
            <hr class="my-4">
        </div>

        <form method="post" action="actions/compra.php">
            <input type="hidden" name="id" value="<?php echo urlencode($row['id']); ?>">
            
            <!-- Nombre del Comprador -->
            <div class="form-group">
                <label for="nombre_comprador">Nombre del comprador</label>
                <select id="nombre_comprador" class="form-control" name="nombre_comprador">
                    <?php foreach ($users as $id => $nombre) { ?>
                        <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($nombre); ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- Especie -->
            <div class="form-group">
                <label for="especie">Especie</label>
                <input id="especie" class="form-control" type="text" name="especie" value="<?php echo htmlspecialchars($row['especie']); ?>" readonly>
            </div>

            <!-- Tamaño -->
            <div class="form-group">
                <label for="tamaño">Tamaño</label>
                <input id="tamaño" class="form-control" type="text" name="tamaño" value="<?php echo htmlspecialchars($row['tamaño']); ?>" readonly>
            </div>

            <!-- Ubicación Geográfica -->
            <div class="form-group">
                <label for="ubicacion_geografica">Ubicación Geográfica</label>
                <input id="ubicacion_geografica" class="form-control" type="text" name="ubicacion_geografica"
                       value="<?php echo htmlspecialchars($row['ubicacion_geografica']); ?>" readonly>
            </div>

            <!-- Estado -->
            <div class="form-group">
                <label for="estado">Estado</label>
                <input id="estado" class="form-control" type="text" name="estado" value="<?php echo htmlspecialchars($row['estado']); ?>" readonly>
            </div>

            <!-- Precio -->
            <div class="form-group">
                <label for="precio">Precio</label>
                <input id="precio" class="form-control" type="text" name="precio" value="<?php echo htmlspecialchars($row['precio']); ?>" readonly>
            </div>

            <!-- Foto -->
            <div class="form-group text-center">
                <label for="foto">Foto</label>
                <?php if (isset($row['foto'])): ?>
                    <img id="foto" class="img-fluid rounded shadow mt-2" src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto del árbol">
                <?php else: ?>
                    <p class="text-muted">No hay foto disponible</p>
                <?php endif; ?>
            </div>

            <!-- Botones de Acción -->
            <div class="d-flex justify-content-center my-4">
                <button type="submit" class="btn btn-primary mx-2">Comprar</button>
                <a href="actions/update.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-warning mx-2">Actualizar Compra</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
