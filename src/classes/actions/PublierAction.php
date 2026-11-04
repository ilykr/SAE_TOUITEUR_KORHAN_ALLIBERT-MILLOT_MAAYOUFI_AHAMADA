<?php

declare(strict_types=1);

namespace iutnc\sae\actions;
<<<<<<< HEAD
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
=======

require_once('src/classes/TouiteRepository.php');

use iutnc\sae\TouiteRepository;


class PublierAction
{
    public function execute():string{
        $pdo=TouiteRepository::setConfig('config.db.ini');
        $repository=TouiteRepository::getInstance($pdo);
        $rep=$repository->donnerTruc('machin');
        return $rep;
        /*
        <<<HTML
        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Publier - Touiteur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Touiteur</h1>
        <nav>
            <a href="?action=default">Accueil</a>
            <a href="?action=publier">Publier un touite</a>
        </nav>
    </header>
    <hr>
    <main>
>>>>>>> bf7bb103dc76f5b1672b7c55ccb21920d7e111a7
        <h2>Publier un touite</h2>
        <form action="?action=publier" method="post">
            <label for="utilisateur">Nom d'utilisateur</label>
            <input type="text" id="utilisateur" name="utilisateur" required>

            <label for="texte">Texte (235 caractères maximum, les tags commencent par #)</label>
            <textarea id="texte" name="texte" rows="5" maxlength="235" required></textarea>

            <p><button type="submit">Publier</button></p>
        </form>
<<<<<<< HEAD
        HTML;
=======
    </main>
</body>
</html>

HTML;
*/
>>>>>>> bf7bb103dc76f5b1672b7c55ccb21920d7e111a7
    }
}