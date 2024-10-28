<?php
function getCountry(): array
{
    $conn = getConnection();
    $sql = "SELECT id, name FROM country"; // Ajusta los nombres de los campos y la tabla según tu base de datos
    $result = $conn->query($sql);

    // Inicializa el array
    $country = [];

    // Si hay resultados, los agrega al array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $country[$row['id']] = $row['name'];
        }
    }

    // Cierra la conexión
    $conn->close();

    // Devuelve el array de provincias
    return $country;

}
function getConnection(): bool|mysqli
{
    $connection = mysqli_connect('localhost:3306', 'root', '123456', 'my_trees');
    return $connection;
}
function saveUser($user): bool
{
    $firstName = $user['firstName'];
    $lastName = $user['lastName'];
    $phoneNumber = $user['phoneNumber'];
    $username = $user['username'];
    $address = $user['address'];
    $opcionSeleccionada = $_POST['country'];
    $password = md5($user['password']);

    $sql = "INSERT INTO usuarios (name,lastname,phone_number, username,address,country,password) VALUES ('$firstName','$lastName','$phoneNumber','$username','$address','$opcionSeleccionada','$password')";
    try {
        $conn = getConnection();
        mysqli_query($conn, $sql);
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
    return true;
}
function authenticate($username, $password): bool|array|null
{
    $conn = getConnection();
    $password = md5($password);
    $sql = "SELECT * FROM usuarios WHERE `username` = '$username' AND `password` = '$password'";
    $result = $conn->query($sql);

    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $results = $result->fetch_array();
    $conn->close();
    return $results;
}
function saveCompras($arbol): bool
{
    $nombre_comprador = $arbol['nombre_comprador'];
    $especie = $arbol['especie'];
    $tamaño = $arbol['tamaño'];
    $ubicacion_geografica = $arbol['ubicacion_geografica'];
    $estado = $arbol['estado'];
    $precio = $arbol['precio'];
    $foto = $arbol['foto'];

    $sql = "INSERT INTO mis_compras (nombre_comprador,especie,tamaño,ubicacion_geografica,estado,precio,foto) VALUES ('$nombre_comprador','$especie','$tamaño','$ubicacion_geografica','$estado','$precio','$foto')";

    try {
        $conn = getConnection();
        mysqli_query($conn, $sql);
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
    return true;
}
function UpdateArbol($arbol): bool
{
    $id = $arbol['id']; // Asegúrate de que el ID esté en el array
    $query = "UPDATE arboles SET estado = 'Vendido' WHERE id = ?";

    try {
        $conn = getConnection();
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id); // Vincula el parámetro de ID como entero
        $stmt->execute();

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