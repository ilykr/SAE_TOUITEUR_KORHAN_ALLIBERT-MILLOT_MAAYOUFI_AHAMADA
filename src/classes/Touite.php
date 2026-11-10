<?php

declare (strict_types=1);

namespace iutnc\sae;

class Touite
{

    public function __construct(
        protected String $texte,
        protected String $auteur,
        protected array $tags = [],
        protected ?int $id = null,
        protected ?string $date = null,
        protected ?string $chemin = null
    ){}

    public function getAuteur() { return $this->auteur; }

    public function getTexte() { return $this->texte; }

    public function getTags(): array { return $this->tags; }

    public function getId(): ?int { return $this->id; }

    public function getDate(): ?string { return $this->date; }

    public function getImage(): ?string { return $this->chemin; }

    public function __toString():String{
        return $this->render(false);
    }

    /**
     * $detail = false -> version liste (avec le lien "...")
     * $detail = true  -> version détaillée (sans le lien)
     */
    public function render(bool $detail = false): string
    {
        $auteur = htmlspecialchars($this->auteur);

        // on echappe le texte, puis on transforme chaque #tag en lien
        $texte = htmlspecialchars($this->texte);
        $texte = preg_replace_callback(
            '/#([\p{L}\p{N}_]+)/u',
            fn(array $m): string => '<a href="?action=tag&amp;tag=' . urlencode($m[1]) . '">#' . $m[1] . '</a>',
            $texte
        );

        // date (colonne DATE de la BDD)
        $dateHtml = '';
        if ($this->date !== null) {
            $d = new \DateTime($this->date);
            $dateHtml = '<p>Publié le : ' . $d->format('d/m/Y à H:i') . '</p>';
        }

        // lien "..." vers la vue détaillée (uniquement en mode liste)
        $plus = '';
        if (!$detail && $this->id !== null) {
            $plus = '<p><a href="?action=touite&amp;id=' . $this->id . '">...</a></p>';
        }else{
            $plus = $this->chemin;
        }

        return <<<HTML
        <article class="touite">
            <p>Auteur : <a href="?action=profil&amp;user={$auteur}">{$auteur}</a></p>
            {$dateHtml}
            <p>{$texte}</p>
            {$plus}
        </article>
        HTML;
    }

}