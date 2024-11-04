<?php
include('utils/functions.php');
$conn = getConnection();


// Obtener la fecha actual y la fecha de hace un mes
$fecha_actual = date("Y-m-d");
$fecha_hace_un_mes = date("Y-m-d", strtotime("-1 month"));

// Consultar los árboles que no han sido actualizados en el último mes
$sql = "SELECT nombre_cientifico FROM arboles WHERE fecha_actualizada < '$fecha_hace_un_mes'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear el contenido del correo
    $mensaje = "Los siguientes árboles no han sido actualizados desde hace 1 mes:\n";
    while($row = $result->fetch_assoc()) {
        $mensaje .= $row["nombre_cientifico"] . "\n";
    }

    // Configuración del correo
    $para = "yacquy958@gmail.com";
    $asunto = "Actualización de árboles requerida";
    $contraseña = "jtlb fpvv eisf pocb";
    $cabeceras = "From: yacquy958@gmail.com";

    // Enviar el correo
    if (mail($para, $asunto, $mensaje, $cabeceras)) {
        echo "Correo enviado exitosamente.";
    } else {
        echo "Error al enviar el correo.";
    }
} else {
    echo "Todos los árboles están actualizados.";
}

$conn->close();
?>