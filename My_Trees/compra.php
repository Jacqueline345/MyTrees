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
    <div class="form-group">
            <label for="nombre_comprador"> Nombre del comprador </label>
            <input id="nombre_comprador" class="form-control" type="text" name="nombre_comprador">
        </div>
        <div class="form-group">
            <label for="especie"> Especie </label>
            <input id="especie" class="form-control" type="text" name="especie" value = "<?php echo isset($row['especie']) ? htmlspecialchars($row['especie']): ''; ?>">
        </div>
        <div class="form-group">
            <label for="tamaño"> Tamaño </label>
            <input id="tamaño" class="form-control" type="text" name="tamaño" value = "<?php echo isset($row['tamaño']) ? htmlspecialchars($row['tamaño']): ''; ?>">
        </div>
        <div class="form-group">
            <label for="ubicacion_geografica"> Ubicacion geografica </label>
            <input id="ubicacion_geografica" class="form-control" type="text" name="ubicacion_geografica" value="<?php echo isset($row['ubicacion_geografica']) ?  htmlspecialchars($row['ubicacion_geografica']): ''; ?>">
        </div>
        <div class="form-group">
            <label for="estado"> Estado </label>
            <input id="estado" class="form-control" type="text" name="estado" value="<?php echo isset($row['estado']) ? htmlspecialchars($row['estado']): ''; ?>">
        </div>
        <div class="form-group">
            <label for="precio"> Precio </label>
            <input id="precio " class="form-control" type="text" name="precio" value="<?php echo isset($row['precio']) ? htmlspecialchars($row['precio']): ''; ?>">
        </div>
        <div class="form-group">
            <label for="foto"> Foto </label>
            <img id="foto" class="form-control" src="compra.php" alt="foto" value="<?php echo isset($row['foto']) ? htmlspecialchars($row['foto']): ''; ?>">
        </div>
    </form>
    </div>
</body>

</html>
