<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('minha_fila', false, true, false, false);

$msg = new AMQPMessage('Olá do PHP puro!');
$channel->basic_publish($msg, '', 'minha_fila');

echo "Mensagem enviada com sucesso!\n";

$channel->close();
$connection->close();
