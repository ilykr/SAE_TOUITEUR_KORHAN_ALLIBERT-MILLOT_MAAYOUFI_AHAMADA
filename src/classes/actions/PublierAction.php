<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

require_once('src/classes/TouiteRepository.php');

use iutnc\sae\renderer\PublierRenderer;
use iutnc\sae\TouiteRepository;


class PublierAction
{
    public function execute():string{
//        $pdo=TouiteRepository::setConfig('config.db.ini');
//        $repository=TouiteRepository::getInstance($pdo);
//        $rep=$repository->donnerTruc('machin');
//        return $rep;

        return (new PublierRenderer())->render();
    }

}