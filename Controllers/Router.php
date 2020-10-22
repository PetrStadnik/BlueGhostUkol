<?php


class Router extends Controller
{
    protected $calledController;

    public function main($param)
    {
        $parURL = $this->parseURL($param[0]); // rozložení url do pole
        $parURLto = array_shift($parURL);
        $controller = $parURLto; //první prvek z pole je název kontroleru

        $this->calledController = new ContactsController();
        $no = array_search(str_replace('-', ' ',urldecode($controller)), array_column($this->calledController->contacts, "name")); //zjistí zda v url není přímo jméno něajkého kontaktu

        if (is_numeric($no)){ //pokud ano, pak zobrazí pohled pro úpravu daného kontaktu

            $this->calledController->edit($this->calledController->contacts[$no]["id"]);
            $this->view = 'layout';
        }
        else{ // pokud ne,
            $controller = $parURLto . 'Controller';
            if (file_exists('Controllers/' . $controller . '.php')) { //tak ověří, zda je zadáno jméno existujícího kontroleru a následně jej zavolá
                if ($controller == "Controller") // pokud není zadáno nic, zobrazí výpis kontaktů
                    $controller = "ContactsController";
            }
            else{ // stejně tak, pokud pokud zadaný název neexistuje
                $controller = "ContactsController";
                header("Location: /");
            }
            $this->calledController = new $controller; //zavolá kontroler
            $this->calledController->main($parURL); // a jeho zálkadní metodu
            $this->view = 'layout';
        }






    }


    private function parseURL($url)
    {
        $parURL = parse_url($url);
        $parURL["path"] = ltrim($parURL["path"], "/");
        $parURL["path"] = trim($parURL["path"]);
        return explode("/", $parURL["path"]);
    }

}