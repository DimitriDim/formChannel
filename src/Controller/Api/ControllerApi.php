<?php
namespace App\Controller\Api;

use App\Response;
use InvalidArgumentException;
use App\Model\User;
use App\Role\Role;

class ControllerApi
{
 

    protected $response;
    protected $idChannel;
    
    public function __construct(){
        $this->response = new Response();
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