<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");  // Redirigir al login si no está autenticado
    exit();
}

// Conexión a la base de datos
include('db.php');

// Obtener las categorías de la base de datos
$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);

// Mostrar las categorías en el frontend
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Mostrar cada categoría con su presupuesto
        echo "<div class='category-card' style='background-image: url(\"../assets/gif_categoria" . $row['id'] . ".gif\");'>";
        echo "<div class='overlay'></div>";
        echo "<div class='category-info'>";
        echo "<h3>" . $row['nombre'] . "</h3>";
        echo "<p>Presupuesto: $" . $row['presupuesto'] . "</p>";
        echo "<p>Descripción: Controla tus gastos en " . $row['nombre'] . ".</p>";
        echo "</div></div>";
    }
} else {
    echo "No hay categorías disponibles.";
}

$conn->close();
