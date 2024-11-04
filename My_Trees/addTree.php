<?php
session_start();
require('utils/functionsAdmin.php');

if ($_POST) {
    $especie = $_POST['especie'];
    $nombre_cientifico = $_POST['nombre_cientifico'];
    $tamaño = $_POST['tamaño'];
    $ubicacion_geografica = $_POST['ubicacion_geografica'];
    $precio = $_POST['precio'];
    $foto = $_FILES['foto'];

    if (addTree($especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $precio, $foto)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Error al agregar el árbol. Inténtalo nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Árbol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h2>Agregar Nuevo Árbol</h2>
            </div>
            <div class="card-body">
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php } ?>
                <form method="POST" action="addTree.php">
                    <div class="form-group">
                        <label for="especie">Especie:</label>
                        <input type="text" name="especie" id="especie" required class="form-control" placeholder="Ingrese la especie">
                    </div>
                    <div class="form-group">
                        <label for="nombre_cientifico">Nombre Científico:</label>
                        <input type="text" name="nombre_cientifico" id="nombre_cientifico" required class="form-control" placeholder="Ingrese el nombre científico">
                    </div>
                    <div class="form-group">
                        <label for="tamaño">Tamaño:</label>
                        <input type="text" name="tamaño" id="tamaño" required class="form-control" placeholder="Ingrese el tamaño">
                    </div>
                    <div class="form-group">
                        <label for="ubicacion_geografica">Ubicación Geográfica:</label>
                        <input type="text" name="ubicacion_geografica" id="ubicacion_geografica" required class="form-control" placeholder="Ingrese la ubicación geográfica">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="text" name="precio" id="precio" required class="form-control" placeholder="Ingrese el precio">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Guardar Árbol</button>
                        <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
