<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

class TouiteAction extends Action{
    protected string $title = 'Touite';

    public function execute():string {
        return <<<HTML
                    <h2>Touite</h2>
                    <article class="touite">
                        <p>Auteur : <a href="?action=profil">John Doe</a></p>
                        <p>Publié le : 03/11/2026 à 14:30</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<a href="?action=tag">#web</a> Mauris vulputate metus lorem, at elementum massa ornare maximus.<a href="?action=tag">#php</a></p>
                        <p>Note : 3</p>
                    </article>
                    <p><a href="?action=default">&lt; Retour à la liste</a></p>
            HTML;
    }
}