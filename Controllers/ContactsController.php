<?php


class ContactsController extends Controller // kontroler obsahující výpis kontaktů a metody pro práci s nimi
{
    public $contacts;
    public $editContact;

    function __construct()
    {
        $this->contacts = DB::getAll(); // při zavolání načte z databáze seznam kontaktů
    }

    public function main($param){
        if ($param[0] =="remove") // pokud jeho první parametr je remove zavolá metodu pro odstranění kontaktu z databáze
            $this->remove($param[1]);
        else // jinak zobrazí kontakty
            $this->view = "MainView";
    }

    public function edit($id){ // funkce pro úpravu kontaktu
        $this->editContact = $this->contacts[array_search($id, array_column($this->contacts, "id"))]; // na základě id najde v seznamu daný kontakt
        if ($_POST) // pokud je odceslán formulář
        {
            DB::edit(array($_POST['name'], $_POST['tel'], $_POST['mail'], $_POST['note'], $id)); // pošle nové údaje do databáze podle id kontaktu
            header("Location: /"); // přesměruje na úvodní stránku
        }
        $this->view = "EditView"; // a jeho parametry zobrazí
    }

    private function remove($id){
        DB::delete($id); // odstranění kontaktu z databáze
        header("Location: /");
    }

}