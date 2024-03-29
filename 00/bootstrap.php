<?php

require __DIR__.'/vendor/autoload.php';

$settings= require __DIR__.'/src/settings.php';
$app = new \Slim\App($settings);

require __DIR__.'/src/routes.php';

$app->run();