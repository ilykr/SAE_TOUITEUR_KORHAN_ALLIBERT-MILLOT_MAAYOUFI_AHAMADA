<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

require_once('src/classes/TouiteRepository.php');
use iutnc\sae\TouiteRepository;

class PourVousAction extends Action
{
    protected string $title = 'Pour toi';

    public function execute(): string
    {
        $html = '<h2>Pour toi</h2>
        <form action="?action=pourvous" method="post">
            <label for="utilisateur">Nom d\'utilisateur</label>
            <input type="text" id="utilisateur" name="utilisateur" required>
            <p><button type="submit">Valider</button></p>
        </form>';

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $html;
        }

        $user = trim($_POST['utilisateur'] ?? '');
        if ($user === '') {
            return $html . '<p>Veuillez entrer un nom d\'utilisateur.</p>';
        }

        TouiteRepository::setConfig('config.db.ini');
        $repository = TouiteRepository::getInstance();

        // Touites des comptes et des tags suivis, du plus récent au plus ancien
        $touites = $repository->donnerPage($user);

        $html .= '<h3>Touites pour ' . htmlspecialchars($user) . '</h3>';

        $nbAffiches = 0;
        foreach ($touites as $touite) {
            // donnerTouite() renvoie un touite vide si l'id n'existe pas : on l'ignore
            if ($touite->getTexte() !== '') {
                $html .= $touite;
                $nbAffiches++;
            }
        }

        if ($nbAffiches === 0) {
            $html .= '<p>Aucun touite pour le moment. Abonnez-vous à des comptes ou à des tags !</p>';
        }

        return $html;
    }
}