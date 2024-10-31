<?php
function getConnection(): bool|mysqli
{
    $connection = mysqli_connect('localhost:3306', 'root', '', 'my_trees');
    return $connection;
}

/**
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

// Obtener todos los árboles con su estado (en una sola lista)
function getAllTrees(): array
{
    $conn = getConnection();
    $sql = "SELECT id, especie, nombre_cientifico, tamaño, ubicacion_geografica, estado FROM arboles ORDER BY especie ASC";
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

function updateTree($id, $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado) {
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE arboles SET especie = ?, nombre_cientifico = ?, tamaño = ?, ubicacion_geografica = ?, estado = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        $stmt->close();
        $conn->close();
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

function addTree($especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado): bool
{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO arboles (especie, nombre_cientifico, tamaño, ubicacion_geografica, estado) VALUES (?, ?, ?, ?, ?)");
    
    $stmt->bind_param("sssss", $especie, $nombre_cientifico, $tamaño, $ubicacion_geografica, $estado);
    
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    
    return $success;
}

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

