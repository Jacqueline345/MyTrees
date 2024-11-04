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
    $connection = mysqli_connect('localhost:3306', 'root', '123456', 'my_trees');//aqui siempre hay que cambiar la contraseña
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
function authenticate($username, $password, $role): bool|array|null
{
    $conn = getConnection();
    $password = md5($password);
    
    // Ajuste para buscar el rol "amigo" en la tabla `usuarios`
    if ($role === 'amigo') {
        $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ? AND role = 'amigo'";
    } elseif ($role === 'admin') {
        $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    } else {
        return false;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
        $conn->close();
        return $user;
    } else {
        $stmt->close();
        $conn->close();
        return null;
    }
}


function saveCompras($arbol,$user): bool
{
    $nombre_comprador = $user['name'];
    $id_usuario = $user['id'];
    $id_arbol = $arbol['id'];
    $especie = $arbol['especie'];
    $tamaño = $arbol['tamaño'];
    $ubicacion_geografica = $arbol['ubicacion_geografica'];
    $estado = $arbol['estado'];
    $precio = $arbol['precio'];
    $foto = $arbol['foto'];

    $sql = "INSERT INTO mis_compras (nombre_comprador, id_usuario, id_arbol, especie, tamaño, ubicacion_geografica, estado, precio, foto) 
            VALUES ('$nombre_comprador', $id_usuario, $id_arbol, '$especie', '$tamaño', '$ubicacion_geografica', '$estado', '$precio', '$foto')";

    try {
        $conn = getConnection();
        mysqli_query($conn, $sql);
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
    return true;
}
