<?php
session_start();
require_once 'config.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar el usuario en la base de datos
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $username;
        header('Location: index.php'); // Redirigir al home si el login es exitoso
    } else {
        echo "Credenciales incorrectas";
    }
}
?>

<form action="/api/login" method="POST">
    <label for="username">Usuario</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Iniciar Sesión</button>
</form>