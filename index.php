<?php

declare (strict_types=1);

require_once('src/loader/Psr4ClassLoader.php');
$loader=new \loader\Psr4ClassLoader('iutnc\\sae','src/classes');
$loader->register();

use \iutnc\sae\Touite;

$touite1=new Touite("a","b",["#l","#o"]);

echo $touite1;
