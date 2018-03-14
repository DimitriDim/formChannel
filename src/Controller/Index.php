<?php
namespace App\Controller;

class Index extends Controller
{

    public function index()
    {
        $this->init();
        return $this->render("index.html.php");
    }
}