<?php
// Aquí agregamos la lógica PHP para manejar los datos, conectar a una base de datos si es necesario, etc.

// Ejemplo de como se podrían manejar las categorías (en este caso, simulando datos)
$categories = [
    'Comida' => 500,
    'Transporte' => 100,
    'Ropa' => 150,
];

// Mostrar las categorías
foreach ($categories as $category => $budget) {
    echo "<p>$category: $budget</p>";
}

// Puedes expandir esto para manejar formularios, guardar datos de gastos, y actualizar presupuestos.
?>
