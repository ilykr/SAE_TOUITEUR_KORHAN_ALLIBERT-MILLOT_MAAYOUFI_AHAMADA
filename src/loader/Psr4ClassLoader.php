<?php

namespace loader;

class Psr4ClassLoader{
    public function __construct(private string $prefixe, private string $chemin){}

    public function loadClass(string $nom){
        $nom=str_replace($this->prefixe,$this->chemin,$nom).'.php';
        $nom=str_replace('\\','/',$nom);
        if (is_file($nom)) require_once($nom);
    }

    public function register(){
        spl_autoload_register([$this,'loadClass']);
    }
}