<?php

declare (strict_types=1);

namespace iutnc\sae\actions;

require_once('src/classes/TouiteRepository.php');
use iutnc\sae\TouiteRepository;

class TouiteAction extends Action{
    protected string $title = 'Touite';

    public function execute():string {
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            return '<p>Touite invalide.</p><p><a href="?action=default">&lt; Retour à la liste</a></p>';
        }

        TouiteRepository::setConfig('config.db.ini');
        $repository = TouiteRepository::getInstance();
        $touite = $repository->donnerTouite($id);

        // donnerTouite() renvoie un touite vide si l'id n'existe pas
        if ($touite->getTexte() === '') {
            return '<p>Ce touite n\'existe pas.</p><p><a href="?action=default">&lt; Retour à la liste</a></p>';
        }

        return '<h2>Touite</h2>'
             . $touite->render(true)
             . '<p><a href="?action=default">&lt; Retour à la liste</a></p>';
    }
}