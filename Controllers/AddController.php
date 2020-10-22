<?php


class AddController extends Controller //kontroler pro přidávání kontaktů
{

    function main($param)
    {

        if ($_POST) // pokud je něco odesláno
        {
            DB::insert(array($_POST['name'], $_POST['tel'], $_POST['mail'], $_POST['note'])); // tak vloží do databáze
            header("Location: /"); // a přesměruje zpět na hlavní stránku
        }

        $this->view = "AddView";
    }
}