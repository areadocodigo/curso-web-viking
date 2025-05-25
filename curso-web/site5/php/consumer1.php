<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('minha_fila', false, true, false, false);

echo "Aguardando mensagens. Pressione CTRL+C para sair.\n";

$callback = function ($msg) use ($channel) {
    file_put_contents('log_1.txt', $msg->body . PHP_EOL, FILE_APPEND);
    echo "Mensagem capturada!" . "\n";
};

$channel->basic_consume('minha_fila', '', false, true, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}
