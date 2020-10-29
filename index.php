<?php

require_once realpath("vendor/autoload.php");

require_once "routes.php";

use \App\Framework\Kernel;

$kernel = new Kernel();

$kernel->handle();






