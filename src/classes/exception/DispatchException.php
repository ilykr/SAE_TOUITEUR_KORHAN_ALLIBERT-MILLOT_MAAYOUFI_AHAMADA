<?php

declare (strict_types=1);

namespace iutnc\sae\exception; 

class DispatchException extends Exception
{

    /**
     * @param string $string
     */
    public function __construct(string $string) {
        parent::__construct($string);
    }
}