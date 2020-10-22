<?php
mb_internal_encoding("UTF-8");
require('Controllers/Controller.php'); //načtení použitých tříd
require('Controllers/Router.php');
require('Controllers/ContactsController.php');
require('Controllers/AddController.php');
require('Models/DB.php');
DB::connect("a029um.forpsi.com", "f138387", "*******", "f138387"); //připojení k databázi
$router = new Router(); // vytvoření nové instance hlavní třídy pro přesměrovávání a řízení kontrolerů
$router->main(array($_SERVER['REQUEST_URI']));
$router->showView();

