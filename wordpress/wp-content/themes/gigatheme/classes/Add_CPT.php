<?php

class Add_CPT
{
    private array $labels;
    private array $args;
    private string $cptslugname;

    public function __construct(string $cptslugname,array $labels, array $args)
    {
        $this->labels = $labels;
        $this->args = $args;
        $this->args += ['labels' => $this->labels];
        $this->cptslugname = $cptslugname;
        $this->register();
    }

    public function register()
    {
        add_action( 'init' , [$this,'gigabnb_register_event_cpt']); // add custom post type (cpt) -> use this to manage products
    }

    public function gigabnb_register_event_cpt()
    {
        register_post_type($this->cptslugname,$this->args);
    }
}