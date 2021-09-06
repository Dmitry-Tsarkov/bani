<?php

use Cekurte\Environment\Environment;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

if (file_exists(dirname(__DIR__) . '/.env')) {
    $dotenv = new Dotenv();
    $dotenv->load(dirname(__DIR__) . '/.env');
}

defined('YII_DEBUG') or define('YII_DEBUG', Environment::get('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', Environment::get('YII_ENV'));

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
