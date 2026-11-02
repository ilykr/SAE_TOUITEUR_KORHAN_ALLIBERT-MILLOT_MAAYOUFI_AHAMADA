<?php
declare(strict_types=1);

use iutnc\sae\exception\DispatchException;

class Dispatcher
{
    protected ?string $action = null;
    protected array $actions = [];
    public function __construct(){
        $this->action = $_GET['action'] ?? 'default';
    }
    public function addRoute(string $action, string $action_class) : Dispatcher
    {
        $this->actions[$action] = $action_class;
        return $this;
    }

    /**
     * @throws DispatchException
     */
    public function run() : string {
        if (array_key_exists($this->action, $this->actions)) {
            $action_class = $this->actions[$this->action];
            $action_instance = new $action_class();
            return $action_instance->execute();
        }
        throw new DispatchException("Action '{$this->action}' not found");
    }
}