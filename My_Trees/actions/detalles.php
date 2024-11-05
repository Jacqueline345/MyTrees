<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_trees";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sql = "SELECT id, especie, tamaño, ubicacion_geografica, estado, precio, foto FROM mis_compras WHERE id= ?";
    $result = $conn->prepare($sql);
    $result->bind_param("i", $id);
    $result->execute();
    $result = $result->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        echo "Id: " . htmlspecialchars($row['id']) . "<br>";
        echo "Especie: " . htmlspecialchars($row['especie']) . "<br>";
        echo "Tamaño: " . htmlspecialchars($row['tamaño']) . "<br>";
        echo "Ubicacion: " . htmlspecialchars($row['ubicacion_geografica']) . "<br>";
        echo "Estado: " . htmlspecialchars($row['estado']) . "<br>";
        echo "Precio: " . htmlspecialchars($row['precio']) . "<br>";
        echo "Foto: " . htmlspecialchars($row['foto']) . "<br>";
    }
} else {
    echo "No hay arboles registrados.";
}

?>