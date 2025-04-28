<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = htmlspecialchars($_POST['category']);
    $amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
    $description = htmlspecialchars($_POST['description']);
    $date = htmlspecialchars($_POST['date']);

    if ($amount > 0) {
        $stmt = $pdo->prepare("INSERT INTO gastos (categoria_id, monto, descripcion, fecha) VALUES (:category, :amount, :description, :date)");
        $stmt->execute([
            'category' => $category,
            'amount' => $amount,
            'description' => $description,
            'date' => $date
        ]);
        echo "Gasto agregado exitosamente.";
    } else {
        echo "El monto debe ser mayor a 0.";
    }
}

$conn->close();
