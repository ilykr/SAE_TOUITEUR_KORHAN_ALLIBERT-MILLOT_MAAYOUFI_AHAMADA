<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

class ProfilAction extends Action {
    protected string $title = 'Profil';

    public function execute():string {
        return <<<HTML
                    <h2>Touites de John Doe</h2>
                    <article class="touite">
                        <p><a href="?action=profil">John Doe</a> <span class="date">- 03/11/2026 14:30</span></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="?action=tag">#web</a> ... <a href="?action=touite">Voir le détail</a></p>
                    </article>
                    <article class="touite">
                        <p><a href="?action=profil">John Doe</a> <span class="date">- 03/11/2026 14:30</span></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="?action=tag">#web</a> ... <a href="?action=touite">Voir le détail</a></p>
                    </article>
                    <div class="pagination">
                        <a href="?action=profil">&lt; Page précédente</a>
                        <span>Page 1</span>
                        <a href="?action=profil">Page suivante &gt;</a>
                    </div>
            HTML;
    }
}