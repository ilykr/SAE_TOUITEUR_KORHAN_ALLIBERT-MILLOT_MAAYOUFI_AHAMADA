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

        $comptes = $repository->donnerTopFollowers(10);

        $html = '<h2>Comptes les plus suivis</h2>';

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

        return $html;
    }
}