<?php
namespace App\Controller;

class Hello extends Controller
{

    public function say()
    {
        return $this->render("hellosay.html.php", [
            "titre" => "Mon titre",
            "titre2" => "Vive le PHP"
        ]); // clef => valeur
    }

    public function sayTo()
    {
        return $this->render("hellosayto.html.php", [
            "titre" => "Mon titre",
            "titre2" => "Vive le PHP"
        ]);
    }
}
    