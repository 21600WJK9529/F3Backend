<?php
//require 'vendor/autoload.php';
require_once('vendor/autoload.php');

$f3 = Base::instance();

//$f3->set('AUTOLOAD', 'app/');

//$f3->route('GET /', 'Controller\Homepage->testing');
$f3->config('app/config/routes/routes.ini');
$f3->config('app/config/setup.ini');
$f3->config('app/config/mysql.ini');

$f3->run();

