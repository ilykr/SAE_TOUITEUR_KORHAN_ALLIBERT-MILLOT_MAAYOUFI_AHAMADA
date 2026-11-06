<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

require_once('src/classes/TouiteRepository.php');
use iutnc\sae\TouiteRepository;


class DefaultAction extends Action
{
    protected string $title = 'Accueil';

    public function execute(): string
    {
        TouiteRepository::setConfig('config.db.ini');
        $repository = TouiteRepository::getInstance();

        $html = '<h2>Derniers touites</h2>';

        $i = $repository->donnerIdVieux();
        $nbAffiches = 0;

        // Du plus récent au plus ancien
        while ($i > 0) {
            $touite = $repository->donnerTouite($i);

            // donnerTouite() renvoie un touite vide si l'id n'existe pas : on l'ignore
            if ($touite->getTexte() !== '') {
                $html .= $touite;   // appelle __toString()
                $nbAffiches++;
            }
            $i--;
        }

        if ($nbAffiches === 0) {
            $html .= '<p>Aucun touite pour le moment.</p>';
        }

        return $html;
    }
}