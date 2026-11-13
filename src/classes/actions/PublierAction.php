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
        $repository->actualiserImages();
        $images = $repository->chercheImages();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $t = $this->traiterFormulaire();
            $imageId = $_POST['image'] ?? null;
            $repository->ecrireTouite($t->getAuteur(), $t->getTexte(),$t->getTags(),(int) $imageId);
        }
        return $this->afficherFormulaire($images);
    }

    private function traiterFormulaire(): Touite
    {
        // Nettoyage des entrées
        $auteur = $_POST['utilisateur'];
        $texte  = $_POST['texte'];

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

    private function afficherFormulaire(array $images): string
    {
        $html = '
        <h2>Publier un touite</h2>
        <form action="?action=publier" method="post">

            <label for="utilisateur">Nom d\'utilisateur</label>
            <input type="text" id="utilisateur" name="utilisateur" required>

            <label for="texte">Texte</label>
            <textarea id="texte" name="texte" rows="5" maxlength="235" required></textarea>

            <p>Choisissez une image :</p>
        ';

        foreach ($images as $img) {
            $html .= '
            <label style="margin-right:10px;">
                <input type="radio" name="image" value="'.$img['ID'].'">
                <img src="'.$img['CHEMIN'].'" width="100">
            </label>
            ';
        }

        $html .= '
            <p><button type="submit">Publier</button></p>
        </form>
        ';

        return $html;
    }
}