<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

class TagAction {
    public function execute():string {
        return <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Tag #web - Touiteur</title>
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
                    <h2>Touites avec le tag #web</h2>
                    <article class="touite">
                        <p><a href="?action=profil">John Doe</a> <span class="date">- 03/11/2026 14:30</span></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="?action=tag">#web</a> ... <a href="?action=touite">Voir le détail</a></p>
                    </article>
                    <article class="touite">
                        <p><a href="?action=profil">Jane Doe</a> <span class="date">- 03/11/2026 14:30</span></p>
                        <p>Mauris vulputate metus lorem, at elementum massa ornare maximus. <a href="?action=tag">#web</a> ... <a href="?action=touite">Voir le détail</a></p>
                    </article>
                    <div class="pagination">
                        <a href="?action=tag">&lt; Page précédente</a>
                        <span>Page 1</span>
                        <a href="?action=tag">Page suivante &gt;</a>
                    </div>
                </main>
            </body>
            </html>
            HTML;
    }
}