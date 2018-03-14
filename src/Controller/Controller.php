<?php
namespace App\Controller;

use App\Response;
use InvalidArgumentException;
use App\Model\User;
use App\Role\Role;

class Controller
{

    const INCLUDE_PATH = __DIR__ . "/../../src/Ressources/views/";

    // le 2e parametre étant optionnel, on l'affect à [] au cas ou il n'y a rien
    protected function render(string $view, array $parameters = []) // imitation Symfony controller (render)
    {
        $filename = self::INCLUDE_PATH . $view; // sel:: pour dire que c'est une constante de cette classe
        
        if (! is_readable($filename)) {
            throw new InvalidArgumentException("Can't acces directly to file view");
        }
        
        extract($parameters); // atteindre directement les valeurs via les clefs dans les template
        
        /**
         * ** encadrer le include en le mettant dans le tampon pour ne pas qu'il parte au nivigateur direct ***
         */
        /* ça evite le side effet */
        
        ob_start(); // tampon open
        include $filename;
        $file_content = ob_get_contents(); // on ajoute l'include (actuellement dans le tampon) via cette methode
        ob_end_clean(); // tampon clean et die
        
        $response = new Response();
        $response->setBody($file_content);
        return $response;
    }

    /**
     * Démarre la session
     */
    protected function init()
    {
        session_start();
        
        $user = new User();
        
        if (! array_key_exists("user", $_SESSION)) { // si la session n'existe pas, on lui donne un profile (si pas de session)
            $user->agent = filter_input(INPUT_SERVER, "HTTP_USER_AGENT");
            $user->ip = filter_input(INPUT_SERVER, "REMOTE_ADDR");
            $user->timestamp = time();
            $user->role = Role::VISITOR_VALUE; // met le role Visitor à l'initialisation
            $user->token = md5(uniqid(uniqid(), true)); // offusquer en MD5 (fonction de typer hash) pour ne pas trouver le format
            return $_SESSION["user"] = $user; // ATTENTION ici $_SESSION["user"]=new User();
        }
        return $this->authorise();
    }

    protected function authorise()
    {
        
        // vérification vol de session
        if ($_SESSION["user"]->agent !== filter_input(INPUT_SERVER, "HTTP_USER_AGENT") || $_SESSION["user"]->ip !== filter_input(INPUT_SERVER, "REMOTE_ADDR")) {
            $this->revoke();
            throw new \RuntimeException("Authorization failure");
        }
        
        return true;
    }

    protected function revoke()
    { // si différent (vol de cookies)
        return session_destroy();
    }
}