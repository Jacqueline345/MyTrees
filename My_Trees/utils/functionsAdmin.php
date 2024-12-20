<?php
/**
 * Summary of getConnection
 * @return bool|mysqli
 * ace la conexión a la base de datos
 */
function getConnection(): bool|mysqli
{
    $connection = mysqli_connect('localhost:3306', 'root', '', 'my_trees');
    return $connection;
}

/**
 * Summary of getFriendsCount
 * @return int
 * Obtener la cantidad de amigos registrados (desde la tabla usuarios)
 */
function getFriendsCount(): int
{
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as count FROM usuarios";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    $conn->close();
    return (int) $count;
}

/**
 * Summary of getAvailableTreesCount
 * @return int
 * Obtener la cantidad de árboles disponibles
 */
function getAvailableTreesCount(): int
{
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as count FROM arboles WHERE estado = 'disponible'";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    $conn->close();
    return (int) $count;
}

/**
 * Summary of getSoldTreesCount
 * @return int
 * Obtener la cantidad de árboles vendidos
 */
function getSoldTreesCount(): int
{
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as count FROM arboles WHERE estado = 'Vendido'";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    $conn->close();
    return (int) $count;
}

/**
 * Summary of getAllTrees
 * @return array
 * Obtener todos los árboles disponibles
 */
function getAllTrees(): array
{
    $conn = getConnection();
    $sql = "SELECT id, especie, nombre_cientifico, tamaño, ubicacion_geografica, estado, precio, foto
            FROM arboles WHERE estado = 'disponible';"; 
    $result = $conn->query($sql);

    $trees = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $trees[] = $row;
        }
    }
    $conn->close();
    return $trees;
}

/**
 * Summary of updateTree
 * @param mixed $id
 * @param mixed $especie
 * @param mixed $nombre_cientifico
 * @param mixed $tamaño
 * @param mixed $ubicacion_geografica
 * @param mixed $estado
 * @param mixed $precio
 * @param mixed $fotoPath
 * @return bool
 * Actualiza la información del árbol
 */
function updateTree($id, $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado, $precio, $fotoPath = null)
{
    $conn = getConnection();
    
    // Preparar la consulta de actualización
    if ($fotoPath) {
        // Si se proporciona una nueva foto, actualizamos también el campo foto
        $stmt = $conn->prepare("UPDATE arboles SET especie = ?, nombre_cientifico = ?, tamaño = ?, ubicacion_geografica = ?, estado = ?, precio = ?, foto = ?, fecha_actualizada = NOW() WHERE id = ?");
        $stmt->bind_param("sssssssi", $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado, $precio, $fotoPath, $id);
    } else {
        // Si no se proporciona una nueva foto, actualizamos sin el campo foto
        $stmt = $conn->prepare("UPDATE arboles SET especie = ?, nombre_cientifico = ?, tamaño = ?, ubicacion_geografica = ?, estado = ?, precio = ?, fecha_actualizada = NOW() WHERE id = ?");
        $stmt->bind_param("ssssssi", $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado, $precio, $id);
    }

    // Ejecutar la consulta
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();

    return $success;
}


/**
 * Summary of getTreeById
 * @param mixed $id
 * @return array|bool|null
 * Obtiene el árbol segín el id que se seleccione
 */
function getTreeById($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM arboles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $tree = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $tree;
    } else {
        $stmt->close();
        $conn->close();
        return false;
    }
}

/**
 * Summary of addTree
 * @param mixed $especie
 * @param mixed $nombre_cientifico
 * @param mixed $tamaño
 * @param mixed $ubicacion_geografica
 * @param mixed $precio
 * @param mixed $foto
 * @return bool
 * Agrega un nuevo árbol
 */
function addTree($especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $precio, $foto): bool
{
    $conn = getConnection();

    // Procesar la imagen
    $uploadDir = 'C:\xampp\Proyecto-613\My_Trees\uploads'; //dirección en la que se encuentran las imagenes
    $filePath = $uploadDir . basename($foto['name']);

    // Mover el archivo subido a la carpeta deseada
    if (!move_uploaded_file($foto['tmp_name'], $filePath)) {
        return false; // Error al mover el archivo
    }

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO arboles (especie, nombre_cientifico, tamaño, ubicacion_geografica, precio, foto) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $precio, $filePath);

    $success = $stmt->execute();
    $stmt->close();
    $conn->close();

    return $success;
}

/**
 * Summary of deleteTree
 * @param mixed $id
 * @return bool
 * se elimina el árbol según el id que se seleccione
 */
function deleteTree($id): bool
{
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM arboles WHERE id = ?");
    $stmt->bind_param("i", $id);

    $success = $stmt->execute();
    $stmt->close();
    $conn->close();

    return $success;
}

/**
 * Summary of getFriendsWithTrees
 * @return array
 * obtener amigos y sus árboles comprados
 */
function getFriendsWithTrees()
{
    $conn = getConnection();
    $query = "
        SELECT usuarios.id AS id_usuario,
               usuarios.name AS nombre_amigo, 
               usuarios.lastname AS apellido_amigo, 
               arboles.id AS arbol_id, 
               arboles.especie, 
               arboles.nombre_cientifico, 
               arboles.tamaño, 
               arboles.ubicacion_geografica, 
               arboles.estado,
               arboles.precio, 
               arboles.foto
        FROM mis_compras
        INNER JOIN usuarios ON mis_compras.nombre_comprador = usuarios.id
        INNER JOIN arboles ON mis_compras.especie = arboles.especie
        ORDER BY usuarios.name;
    ";

    $result = $conn->query($query);
    $friendsWithTrees = [];

    while ($row = $result->fetch_assoc()) {
        $nombreCompleto = $row['nombre_amigo'] . ' ' . $row['apellido_amigo'];
        $arbol = [
            'id' => $row['arbol_id'],
            'especie' => $row['especie'],
            'nombre_cientifico' => $row['nombre_cientifico'],
            'tamaño' => $row['tamaño'],
            'ubicacion_geografica' => $row['ubicacion_geografica'],
            'estado' => $row['estado'],
            'precio' => $row['precio'],
            'foto' => $row['foto'],

        ];

        if (!isset($friendsWithTrees[$nombreCompleto])) {
            $friendsWithTrees[$nombreCompleto] = [];
        }
        $friendsWithTrees[$nombreCompleto][] = $arbol;
    }
    $conn->close();
    return $friendsWithTrees;
}
