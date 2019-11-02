<?php

use OP\Tasks\Kernel;
use OP\Tasks\Http\Request;
use OP\Tasks\Http\Response;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$kernel = new Kernel();
$request = new Request();
$response = $kernel->handle($request);
$response->send();
