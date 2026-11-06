<?php

declare (strict_types=1);

namespace iutnc\sae;

class Touite
{

    public function __construct(protected String $texte, protected String $auteur, protected array $tags = []){}

    public function getAuteur() { return $this->auteur; }

    public function getTexte() { return $this->texte; }

    public function getTags(): array { return $this->tags; }

    public function __toString():String{
        $auteur = htmlspecialchars($this->auteur);

        // On échappe le texte, puis on transforme chaque #tag en lien
        $texte = htmlspecialchars($this->texte);
        $texte = preg_replace_callback(
            '/#([\p{L}\p{N}_]+)/u',
            fn(array $m): string => '<a href="?action=tag&amp;tag=' . urlencode($m[1]) . '">#' . $m[1] . '</a>',
            $texte
        );

        return <<<HTML
        <article class="touite">
            <p>Auteur : <a href="?action=profil&amp;user={$auteur}">{$auteur}</a></p>
            <p>{$texte}</p>
        </article>
        HTML;
    }

}