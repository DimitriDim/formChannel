<?php
namespace App\Controller;

use App\Response;
// use App\PDOHandler;
use App\Role\Role;
use App\DBH;

class SignOut extends Controller
{

    public function signout()
    {
        $this->init();
        $user = $_SESSION["user"];
        $this->revoke();
        $this->downgradeRole($user->email);
        return $this->redirectToUlr();
    }

    public function redirectToUlr()
    {
        $response = new Response();
        $response->addHeader("Location", "/formation-php/web/signin");
        return $response;
    }

    private function downgradeRole($email)
    {
        $PDO = DBH::get(DBH::PDO);
        $sth = $PDO->prepare("UPDATE user SET user_role =" . Role::VISITOR_VALUE . " WHERE user_email= :email ");
        $sth->bindValue(":email", $email); // pour éviter l'injection SQL
        
        return $sth->execute();
    }
}