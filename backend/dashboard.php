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
$query = "SELECT c.name AS categoria, SUM(e.amount) AS total_gasto 
          FROM expenses e 
          INNER JOIN categories c ON e.category_id = c.id 
          GROUP BY c.name";
$stmt = $pdo->prepare($query);
$stmt->execute();
$gastos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener el presupuesto total
$query = "SELECT c.name AS categoria, b.budget 
          FROM budgets b 
          INNER JOIN categories c ON b.category_id = c.id";
$stmt = $pdo->prepare($query); 

$presupuesto = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Datos del dashboard
$data = [
    'gastos' => $gastos,
    'presupuesto' => $presupuesto
];


echo json_encode($data); // Enviar los datos al frontend
