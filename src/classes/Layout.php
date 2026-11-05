<?php
declare(strict_types=1);

namespace iutnc\sae;

class Layout
{
    public static function render(string $title, string $content): string
    {
        $title = htmlspecialchars($title);
        return <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$title} - Touiteur</title>
    <link rel="stylesheet" href="interface/style.css">
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
        {$content}
    </main>
</body>
</html>
HTML;
    }
}