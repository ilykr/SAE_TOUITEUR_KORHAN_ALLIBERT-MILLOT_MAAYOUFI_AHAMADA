<?php

declare(strict_types=1);

namespace iutnc\sae\actions;
require_once('src/classes/TouiteRepository.php');
use iutnc\sae\Touite;
use iutnc\sae\TouiteRepository;

class PublierAction
{
    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->traiterFormulaire();
        }
        return $this->afficherFormulaire();
    }

    private function traiterFormulaire(): string
    {
        // Nettoyage des entrées
        $auteur = $_POST['utilisateur']; //trim(filter_var($_POST['utilisateur'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));
        $texte  = $_POST['texte']; //trim(filter_var($_POST['texte'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));

        if ($auteur === '' || $texte === '') {
            return $this->afficherFormulaire() . '<p>Tous les champs sont obligatoires.</p>';
        }

        // Extraction des tags : #mot | A REFAIRE!!!
        preg_match_all('/#([\p{L}\p{N}_]+)/u', $texte, $matches);
        $tags = array_values(array_unique($matches[1]));

        // Création du touite
        $touite = new Touite($texte, $auteur, $tags);

        return "<p>Touite publié : {$touite}</p>" . $this->afficherFormulaire();
    }

    private function afficherFormulaire(): string
    {
        return <<<HTML
        <h2>Publier un touite</h2>
        <form action="?action=publier" method="post">
            <label for="utilisateur">Nom d'utilisateur</label>
            <input type="text" id="utilisateur" name="utilisateur" required>

            <label for="texte">Texte (235 caractères maximum, les tags commencent par #)</label>
            <textarea id="texte" name="texte" rows="5" maxlength="235" required></textarea>

            <p><button type="submit">Publier</button></p>
        </form>
        HTML;
    }
}