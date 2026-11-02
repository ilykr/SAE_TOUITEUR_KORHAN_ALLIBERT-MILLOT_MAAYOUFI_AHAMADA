<?php

declare (strict_types=1);

namespace iutnc\sae; 


class Touite
{

    public function __construct(protected String $texte, protected String $auteur, protected array $tags = []){}

    public function __toString():String{
        return json_encode(get_object_vars($this));
    }

}