<?php
// filepath: c:\dimater\gastocontrol\gasto-control\router.php

function route($path)
{
    $routes = [
        '' => 'frontend/index.html',
        'home' => 'frontend/index.html',
        'login' => 'frontend/login.html',
        'add-expense' => 'frontend/add_expense.html',
        'api/add-expense' => 'backend/add_expense.php',
        'api/login' => 'backend/login.php',
        'api/logout' => 'backend/logout.php',
    ];

    if (array_key_exists($path, $routes)) {
        include $routes[$path];
    } else {
        http_response_code(404);
        echo "404 - Página no encontrada";
    }
}

function handleRequest()
{
    $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    route($requestUri);
}
