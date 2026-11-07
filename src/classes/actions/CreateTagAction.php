<?php
declare(strict_types=1);
namespace iutnc\sae\actions;
require_once('src/classes/TouiteRepository.php');
use iutnc\sae\Touite;
use iutnc\sae\TouiteRepository;

class CreateTagAction extends Action
{
    protected string $title = 'Touiter';

    public function execute(): string {
        TouiteRepository::setConfig('config.db.ini');
        $repository=TouiteRepository::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $t = $this->traiterFormulaire();
            $repository->creerTag($t);
        }
        return $this->afficherFormulaire();
    }

    private function traiterFormulaire(): array
    {
        // Nettoyage des entrées
        $libelle = $_POST['libelle']; //trim(filter_var($_POST['utilisateur'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));
        $description  = $_POST['description']; //trim(filter_var($_POST['texte'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));

        if ($libelle === '' || $description === '') {
            
            return [];
        }

        return [$libelle, $description];
    }

    private function afficherFormulaire(): string
    {
        return <<<HTML
        <h2>Créer/modifier un tag</h2>
        <form action="?action=tagcreate" method="post">
            <label for="libelle">#</label>
            <input type="text" id="libelle" name="libelle" required>

            <label for="description">Description du tag (235 caractères maximum)</label>
            <textarea id="description" name="description" rows="5" maxlength="235" required></textarea>

            <p><button type="submit">Valider</button></p>
        </form>
        HTML;
    }
}