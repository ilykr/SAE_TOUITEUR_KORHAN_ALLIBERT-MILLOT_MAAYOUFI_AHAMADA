<?php
declare(strict_types=1);
namespace iutnc\sae\actions;
require_once('src/classes/TouiteRepository.php');
use iutnc\sae\Touite;
use iutnc\sae\TouiteRepository;

class PublierAction extends Action
{
    protected string $title = 'Touiter';

    public function execute(): string {
        TouiteRepository::setConfig('config.db.ini');
        $repository=TouiteRepository::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $t = $this->traiterFormulaire();
            $repository->ecrireTouite($t->getAuteur(), $t->getTexte(),$t->getTags());
        }
        return $this->afficherFormulaire();
    }

    private function traiterFormulaire(): Touite
    {
        // Nettoyage des entrées
        $auteur = $_POST['utilisateur']; //trim(filter_var($_POST['utilisateur'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));
        $texte  = $_POST['texte']; //trim(filter_var($_POST['texte'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));

        if ($auteur === '' || $texte === '') {
            $touiteVide = new Touite("","", []);
            return $touiteVide;
        }

        // Extraction des tags : #mot | A REFAIRE!!!
        preg_match_all('/#([\p{L}\p{N}_]+)/u', $texte, $matches);
        $tags = array_values(array_unique($matches[1]));

        // Création du touite
        $touite = new Touite($texte, $auteur, $tags);

        return $touite;
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