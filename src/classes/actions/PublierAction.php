<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

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
        <h2>Publier un touite</h2>
        <form action="#" method="post">
            <label for="utilisateur">Nom d'utilisateur</label>
            <input type="text" id="utilisateur" name="utilisateur" required>

            <label for="texte">Texte (235 caractères maximum, les tags commencent par #)</label>
            <textarea id="texte" name="texte" rows="5" maxlength="235" required></textarea>

            <p><button type="submit">Publier</button></p>
        </form>
    </main>
</body>
</html>

HTML;
*/
    }

}