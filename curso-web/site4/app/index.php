<?php

$redis = new Redis();
$redis->connect('redis', 6379);

$cacheKey = 'total_compras_por_dia';
$cachedData = $redis->get($cacheKey);

if ($cachedData) {
    $resultados = json_decode($cachedData, true);
} else {
    $pdo = new PDO('mysql:host=db;dbname=app_database', 'app_db_admin', 'secure_password');

    $sql = "
        SELECT dia_da_semana, SUM(preco) AS total_vendido
        FROM compras
        GROUP BY dia_da_semana
        ORDER BY dia_da_semana
    ";

    $stmt = $pdo->query($sql);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $redis->setex($cacheKey, 60, json_encode($resultados));
}

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
        <h2 class="subtitle">Calculo gerado no servidor: <?php echo gethostname(); ?></h2>
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