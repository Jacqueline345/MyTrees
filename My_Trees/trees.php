<?php
require('utils/functions.php');
$conn = getConnection();
$sql = "SELECT * FROM arboles WHERE `estado` = 'disponible'";
$result = mysqli_query($conn, $sql);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vista de los arboles </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php require('inc/header.php') ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th> Id </th>
                    <th> Especie </th>
                    <th> Tamaño </th>
                    <th> Ubicación geográfica</th>
                    <th> Estado </th>
                    <th> Precio </th>
                    <th> Foto del arbol </th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['especie']); ?></td>
                        <td><?php echo htmlspecialchars($row['tamaño']); ?></td>
                        <td><?php echo htmlspecialchars($row['ubicacion_geografica']); ?></td>
                        <td><?php echo htmlspecialchars($row['estado']); ?></td>
                        <td><?php echo htmlspecialchars($row['precio']); ?></td>
                        <td><?php echo htmlspecialchars($row['foto']); ?></td>
                        <td> <a href="compra.php?id=<?php echo urlencode($row['id']); ?>" class="btn-primary"> Comprar </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>


    </div>

</body>

</html>