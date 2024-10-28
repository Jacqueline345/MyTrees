<?php
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

// Obtener la cantidad de árboles disponibles
function getAvailableTreesCount(): int
{
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as count FROM arboles WHERE estado = 'disponible'";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    $conn->close();
    return (int) $count;
}

// Obtener la cantidad de árboles vendidos
function getSoldTreesCount(): int
{
    $conn = getConnection();
    $sql = "SELECT COUNT(*) as count FROM arboles WHERE estado = 'vendido'";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    $conn->close();
    return (int) $count;
}

// Obtener todas las especies de árboles
function getTreesByStatus(): array
{
    $conn = getConnection();
    $sql = "SELECT id, especie, nombre_cientifico, tamaño, ubicacion_geografica, estado FROM arboles";
    $result = $conn->query($sql);

    $trees = [
        'disponible' => [],
        'vendido' => []
    ];

    while ($row = $result->fetch_assoc()) {
        if ($row['estado'] === 'disponible') {
            $trees['disponible'][] = $row;
        } else {
            $trees['vendido'][] = $row;
        }
    }

    $conn->close();
    return $trees;
}

function updateTree($id, $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado) {
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE arboles SET especie = ?, nombre_cientifico = ?, tamaño = ?, ubicacion_geografica = ?, estado = ? WHERE id = ?");
    
    // Bind the parameters, make sure the count matches the number of parameters
    $stmt->bind_param("sssssi", $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


function getTreeById($id) {
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



