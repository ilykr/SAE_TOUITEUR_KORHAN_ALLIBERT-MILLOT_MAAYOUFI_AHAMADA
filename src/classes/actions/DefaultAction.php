<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

require_once('src/classes/TouiteRepository.php');
use iutnc\sae\Touite;
use iutnc\sae\TouiteRepository;


class DefaultAction extends Action
{
    protected string $title = 'Accueil';

    public function execute(): string
    {
        TouiteRepository::setConfig('config.db.ini');
        $repository=TouiteRepository::getInstance();
        $t=$repository->donnerTouite(1);
        var_dump($t);
        return <<<HTML
        <h2>Derniers touites</h2>
        <article class="touite">
            <p><a href="?action=profil">John Doe</a> <span class="date">- 03/11/2026 14:30</span></p>
            <p>Lorem ipsum... <a href="?action=tag">#web</a> ... <a href="?action=touite">Voir le détail</a></p>
        </article>
        <div class="pagination">...</div>
HTML;
    }
}