<?php

$host = 'db';
$db = 'app_db';
$user = 'user';
$pass = '123456';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    echo "Conexão bem-sucedida com o MySQL!";
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
