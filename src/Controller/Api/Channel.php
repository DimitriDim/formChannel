<?php
namespace App\Controller\Api;

use App\Response;

class Channel
{

    public function channel(): Response
    {
        
        // 1/ lire les entetes du client
        $accept = filter_input(INPUT_SERVER, "HTTP_ACCEPT");
        
        $response = new Response();
        if ("application/json" !== $accept) {
            
            $response->setStatus(406, "Not acceptable");
        } else {
            $response->setStatus(200, "OK");
            $response->addHeader("Content-Type", "application/json");
            $response->setBody("{}");
        }
        return $response;
    }
}