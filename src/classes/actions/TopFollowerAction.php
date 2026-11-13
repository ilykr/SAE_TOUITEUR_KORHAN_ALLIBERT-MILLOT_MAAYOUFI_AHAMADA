<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

require_once('src/classes/TouiteRepository.php');
use iutnc\sae\TouiteRepository;

class TopFollowerAction extends Action
{
    protected string $title = 'Top abonnés';

    public function execute(): string
    {
        TouiteRepository::setConfig('config.db.ini');
        $repository = TouiteRepository::getInstance();

        $html=$this->afficherFormulaire();

        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = $_POST['utilisateur'];
            if ($admin==='aria'){
                $comptes = $repository->donnerTopFollowers(10);
                if (count($comptes) === 0) {
                    return $html . '<p>Aucun compte pour le moment.</p>';
                }

                $html .= '<ol>';
                foreach ($comptes as $compte) {
                    $nom = (string) $compte['username'];
                    $nb  = (int) $compte['nb'];
                    $html .= '<li><a href="?action=profil&amp;user=' . urlencode($nom) . '">'
                        . htmlspecialchars($nom) . '</a> — '
                        . $nb . ' abonné' . ($nb > 1 ? 's' : '') . '</li>';
                }
                $html .= '</ol>';

            }else{
                $html .= '<p>Utilisateur pas administrateur</p>';
            }
        }

        return $html;
    }

    private function afficherFormulaire(): string
    {
        $html = '
        <h2>Comptes les plus suivis</h2>
        <form action="?action=topfollowers" method="post">

            <label for="utilisateur">Nom d\'utilisateur admin</label>
            <input type="text" id="utilisateur" name="utilisateur" required>

        ';

        $html .= '
            <p><button type="submit">Publier</button></p>
        </form>
        ';
        return $html;
    }
}