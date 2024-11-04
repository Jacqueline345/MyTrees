<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Cargar PHPMailer
require_once('utils/functions.php'); // Asegúrate de usar require_once para evitar duplicaciones

// Datos del correo
$myEmail = "yacquy958@gmail.com";
$myPassword = "jtlb fpvv eisf pocb"; 
$myAlias = "my_trees";
$userEmail = "yacquy958@gmail.com"; // Cambia al correo del destinatario
$userName = "Jacqueline"; // Nombre del usuario

// Crear la conexión a la base de datos
$conn = getConnection();

try {
    // Configurar PHPMailer
    $mail = new PHPMailer(true);
    
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $myEmail;
    $mail->Password = $myPassword;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configuración del correo
    $mail->setFrom($myEmail, $myAlias);
    $mail->addAddress($userEmail);

    // Verificar árboles no actualizados y preparar el mensaje
    $mensaje = verificarArbolesNoActualizados($conn);
    if ($mensaje) {
        $mail -> isHTML(true);
        $mail->Subject = "Árboles desactualizados";
        $mail->Body = $mensaje;

        // Enviar el correo
        $mail->send();
        echo "Correo Enviado";
    } else {
        echo "Todos los árboles están actualizados.";
    }
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}

// Verificar árboles no actualizados y retornar mensaje
function verificarArbolesNoActualizados($conn) {
    $fecha_actual = date("Y-m-d");
    $fecha_hace_un_mes = date("Y-m-d", strtotime("-1 month"));
    
    $sql = "SELECT id, nombre_cientifico FROM arboles WHERE fecha_actualizada < '$fecha_hace_un_mes'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $mensaje = "Los siguientes árboles no han sido actualizados desde hace 1 mes:\n";
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"]; // Asegúrate de tener un ID único para cada árbol
            $nombre_cientifico = $row["nombre_cientifico"];
            // Crear un enlace al árbol
            $mensaje .= "<a href='http://jacqueline.net/my_trees/EditTree.php?id=$id' style='text-decoration: underline;'>$nombre_cientifico</a><br>\n";
        }
        return $mensaje; // Retorna el mensaje
    }
    return null; // Retorna null si no hay árboles desactualizados
}

$conn->close(); // Cerrar la conexión al final del script
?>
