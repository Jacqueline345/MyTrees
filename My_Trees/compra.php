<?php
include('utils/functions.php');
$conn = getConnection();
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

<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php require('inc/header.php') ?>
    <div class="jumbotron">
        <h1 class="display-4"> Compra de arboles </h1>
        <hr class="my-4">
    </div>
    <form method="post" action="actions/compra.php">
    <label> Si deseas comprar, actualiza y luego compras... </label>
    <input type="hidden" name="id" value="<?php echo urlencode($row['id']); ?>">
        <div class="form-group">
            <label for="nombre_comprador"> Nombre del comprador </label>
            <input id="nombre_comprador" class="form-control" type="text" name="nombre_comprador">
        </div>
        <div class="form-group">
            <label for="especie"> Especie </label>
            <input id="especie" class="form-control" type="text" name="especie" value="<?php echo $row['especie']; ?>">
        </div>
        <div class="form-group">
            <label for="tamaño"> Tamaño </label>
            <input id="tamaño" class="form-control" type="text" name="tamaño" value="<?php echo $row['tamaño']; ?>">
        </div>
        <div class="form-group">
            <label for="ubicacion_geografica"> Ubicacion geografica </label>
            <input id="ubicacion_geografica" class="form-control" type="text" name="ubicacion_geografica"
                value="<?php echo $row['ubicacion_geografica']; ?>">
        </div>
        <div class="form-group">
            <label for="estado"> Estado </label>
            <input id="estado" class="form-control" type="text" name="estado" value="<?php echo $row['estado']; ?>">
        </div>
        <div class="form-group">
            <label for="precio"> Precio </label>
            <input id="precio " class="form-control" type="text" name="precio" value="<?php echo $row['precio']; ?>">
        </div>
        <div class="form-group">
            <label for="foto">Foto</label>
            <?php if (isset($row['foto'])): ?>
                <img id="foto" class="img-fluid" src="<?php echo $row['foto']; ?>" alt="foto">
            <?php else: ?>
                <p>No hay foto disponible</p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-warning"> Comprar </button>
    </form>
    <a href="actions/update.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-warning"> Actualiza la
            compra</a>
    </div>
</body>

</html>