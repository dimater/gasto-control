<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    // Insertar el gasto en la base de datos
    $sql = "INSERT INTO gastos (categoria_id, monto, descripcion, fecha) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idss", $category, $amount, $description, $date);

    if ($stmt->execute()) {
        echo "Gasto agregado exitosamente";
    } else {
        echo "Error al agregar el gasto: " . $stmt->error;
    }
}

$conn->close();
