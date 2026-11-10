<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

require_once('src/classes/TouiteRepository.php');
use iutnc\sae\TouiteRepository;

class TagAction extends Action {
    protected string $title = 'Tags';

    public function execute():string {
        $tag=$_GET['tag'];

        TouiteRepository::setConfig('config.db.ini');
        $repository = TouiteRepository::getInstance();

        $html = '<h2>Touites associés au tag #'.$tag.'</h2>';
        $html .= '<form action="?action=tag&tag='.$tag.'" method="post">

            <label for="utilisateur">Nom d\'utilisateur</label>
            <input type="text" id="utilisateur" name="utilisateur" required>
            <p><button type="submit" class="btn-abonner">S\'abonner</button></p>
            </form>';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $follower = $_POST['utilisateur'];
            $repository->suivreTag($follower,$tag);
        }
        $tab = $repository->donnerTouiteTag($tag);
        $nbAffiches = 0;

        // Du plus récent au plus ancien
        foreach($tab as $touite) {

            // donnerTouite() renvoie un touite vide si l'id n'existe pas : on l'ignore
            if ($touite->getTexte() !== '') {
                $html .= $touite;   // appelle __toString()
                $nbAffiches++;
            }
        }

        if ($nbAffiches === 0) {
            $html .= '<p>Aucun touite pour le moment.</p>';
        }

        return $html;
    }
}