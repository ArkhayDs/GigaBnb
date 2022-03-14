<?php

class Custom_role
{
    private string $role;
    private string $display_name;
    private array $capabilities;

    public function __construct(string $role, string $display_name, array $capabilities)
    {
        $this->role = $role;
        $this->display_name = $display_name;
        $this->capabilities = $capabilities;
        $this->register();
    }

    public function register()
    {
        add_action('after_switch_theme', [$this,'gigabnb_role_management']);
    }

    public function gigabnb_role_management()
    {
        remove_role($this->role); // lors du refactor, déplacer cette ligne pour l'exécuter à la désactivation du thèmee ou plugin
        add_role($this->role,$this->display_name, $this->capabilities);
    }

}