<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

class TagAction extends Action {
    protected string $title = 'Tags';

    public function execute():string {
        return <<<HTML
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
            HTML;
    }
}