<?php
require('../utils/functions.php');
$conn = getConnection();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    $query = "UPDATE arboles SET estado = 'Vendido' WHERE id = ?";

    try {
        $conn = getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id); // Vincula el parámetro de ID como entero
        $stmt->execute();
        echo "actualiza la compra exitosamente...";
        if ($stmt->affected_rows === 0) {
            echo "No se encontró el árbol con el ID especificado.";
            return false;
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }

    return true;
}

?>