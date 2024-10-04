<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "order_system";
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO (dsn: $dsn, username: $user, password: $password);
$pdo->exec(statement: "SET time_zone = '+08:00';");

?>