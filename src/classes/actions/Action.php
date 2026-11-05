<?php
declare(strict_types=1);

namespace iutnc\sae\actions;

abstract class Action
{
    protected string $title = 'Touiteur';

    abstract public function execute(): string;

    public function getTitle(): string
    {
        return $this->title;
    }
}