<?php


class Contact
{
    public $name;
    public $tel;
    public $mail;
    public $note;

    function __construct($name, $tel, $mail, $note) {
        $this->name = $name;
        $this->tel = $tel;
        $this->mail = $mail;
        $this->note = $note;
    }

}