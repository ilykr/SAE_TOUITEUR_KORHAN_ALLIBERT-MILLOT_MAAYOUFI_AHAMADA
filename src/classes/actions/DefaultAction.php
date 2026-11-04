<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

use iutnc\sae\renderer\FilRenderer;

class DefaultAction
{
    public function execute():string{
        return (new FilRenderer())->render();
    }
}