<?php

$log = new Monolog\Logger('Studi');
$log->pushHandler(new Monolog\Handler\StreamHandler('php.log', Monolog\Logger::WARNING));