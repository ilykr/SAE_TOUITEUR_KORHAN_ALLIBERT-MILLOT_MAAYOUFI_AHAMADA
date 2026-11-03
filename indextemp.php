<?php
declare (strict_types=1);

require_once('src/loader/Psr4ClassLoader.php');
$loader=new \loader\Psr4ClassLoader('iutnc\\sae','src/classes');
$loader->register();

use \iutnc\sae\Touite;
use \iutnc\sae\Dispatch;
use iutnc\sae\actions\PublierAction;
use iutnc\sae\actions\DefaultAction;

$t=new Touite("a","b",["#l","#o"]);
echo $t;

$disp=new Dispatch();
$disp->addDispatch('default',DefaultAction::class);
$disp->addDispatch('publier',PublierAction::class);

echo $disp->run();