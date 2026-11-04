<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

class TouiteAction {
    public function execute():string {
        return <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Touite - Touiteur</title>
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
                    <h2>Touite</h2>
                    <article class="touite">
                        <p>Auteur : <a href="?action=profil">John Doe</a></p>
                        <p>Publié le : 03/11/2026 à 14:30</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<a href="?action=tag">#web</a> Mauris vulputate metus lorem, at elementum massa ornare maximus.<a href="?action=tag">#php</a></p>
                        <p>Note : 3</p>
                    </article>
                    <p><a href="?action=default">&lt; Retour à la liste</a></p>
                </main>
            </body>
            </html>
            HTML;
    }
}