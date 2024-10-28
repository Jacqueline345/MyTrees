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


