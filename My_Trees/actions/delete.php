<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "my_trees";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $clave = $_GET["id"];

    $stmt = $conn->prepare("DELETE FROM mis_compras WHERE id = ?");
    $stmt->bind_param("i", $clave); 

    if ($stmt->execute()) {
        header("Location: ../trees.php");
        exit();

    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid ID";
}

mysqli_close($conn);
?>
