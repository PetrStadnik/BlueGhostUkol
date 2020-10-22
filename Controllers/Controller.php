<?php


abstract class Controller //Základní třída kontroleru
{
    protected $data = array();
    protected $view = "";

    abstract function main($param);

    public function showView()
    {
        if ($this->view)
        {
            extract($this->data);
            require("Views/" . $this->view . ".phtml");
        }
    }
}