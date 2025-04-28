<?php
// filepath: c:\dimater\gastocontrol\gasto-control\backend\logout.php
session_start();
session_destroy();
header('Location: /login');
exit;
