<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$mysqlDatabaseName = $_ENV['MYSQL_DATABASE'];
$mysqlPassword = $_ENV['MYSQL_PASSWORD'];
$mysqlUsername = $_ENV['MYSQL_USER'];

$pdo = new PDO('mysql:host=localhost;dbname=' . $mysqlDatabaseName, $mysqlUsername, $mysqlPassword);

$sql = "
    SELECT dia_da_semana, SUM(preco) AS total_vendido
    FROM compras
    GROUP BY dia_da_semana
    ORDER BY dia_da_semana
";

$stmt = $pdo->query($sql);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Compras por Dia da Semana</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f7fa;
        }
        
        .container {
            width: 80%;
            max-width: 800px;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .title {
            text-align: center;
            margin-bottom: 5px;
            color: #333;
            font-size: 24px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 20px;
            color: #666;
            font-size: 18px;
        }

        .result ul li {
            list-style: none;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            color: #555;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">
            Total de Compras por Dia da Semana<br>
        </h1>
        <div class="result">
        
            <ul>
            <?php

            foreach ($resultados as $linha) {
                echo "<li><strong>Dia {$linha['dia_da_semana']}: </strong> R$ {$linha['total_vendido']}</li>";
            }

            ?>
            </ul>
        
        </div>
    </div>
</body>
</html>
