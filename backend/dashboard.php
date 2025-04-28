<?php
session_start();
include('db.php'); // Conexión a la base de datos
$_SESSION['user_id'] = 1; // Simulación de un usuario logueado, en producción esto vendría de la sesión
// Verificar que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir si no está logueado
    exit();
}

// Obtener datos de los gastos
$query = "SELECT category, SUM(amount) AS total_gasto FROM expenses WHERE user_id = ? GROUP BY category";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$gastos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener el presupuesto total
$query = "SELECT category, budget FROM budgets WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$presupuesto = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Datos del dashboard
$data = [
    'gastos' => $gastos,
    'presupuesto' => $presupuesto
];

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Permitir acceso desde cualquier origen

echo json_encode($data); // Enviar los datos al frontend
