<?php
declare(strict_types=1);

class Dispatcher
{
    private string $action;
    // Initialisation directe ici pour garantir qu'elle ne soit JAMAIS vide
    private string $view = '';

    public function __construct()
    {
        $this->action = $_GET['action'] ?? 'feed';
    }

    public function run(): void
    {
        switch ($this->action) {
            case 'profil':
                $this->view = __DIR__ . '/views/profile.php';
                break;

            case 'feed':
            default:
                $this->view = __DIR__ . '/views/feed.php';
                break;
        }

        require_once __DIR__ . '/views/layout.php';
    }
}