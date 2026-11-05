<?php

declare (strict_types=1);

namespace iutnc\sae;
use iutnc\sae\exception\DispatchException;
use iutnc\sae\Layout;

class Dispatch
{

    protected ?string $action = null;
    protected array $actions = [];

    public function __construct()
    {
        $this->action = $_GET['action'] ?? 'default';
    }

    public function addDispatch(string $action, string $action_class): Dispatch
    {
        $this->actions[$action] = $action_class;
        return $this;
    }

    /**
     * @throws DispatchException
     */
    public function run(): string
        {
            if (array_key_exists($this->action, $this->actions)) {
                $action_class = $this->actions[$this->action];
                $action_instance = new $action_class();
                $content = $action_instance->execute();          // runs first, may set the title
                return Layout::render($action_instance->getTitle(), $content);
            }
            throw new DispatchException("Action '{$this->action}' not found");
        }
}