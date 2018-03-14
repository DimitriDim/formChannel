<?php
use App\Response;

require __DIR__ . "/../vendor/autoload.php"; //chemin 

 
try {
    
    /**
     * Must be compared to route path
     * @var string
     */
    $url = filter_input(INPUT_SERVER, "REDIRECT_URL");
    
    /**
     * Routes collection
     * @var stdClass $routing
     */
    $routing= json_decode(file_get_contents(__DIR__ . "/../app/config/routing.json"));
    
    //boucler dans l'objet ici les routes
    //Comparer path et url
    if(!$url){
        throw new OutOfBoundsException("Can't acces directly to front controller");
    }

    foreach ($routing as $value){
        $path = $value->path; //on acdède à path
        
        if(preg_match("/^" . str_replace("/", "\/", $path). "$/", $url)){ // comparaison
            
            unset($url); //on supprime la variable, plus utilisé ensuite
            unset($routing);
            
            // on met dans un tableau les 2 parties de $value->controller séparée par ::
            $myTab = explode("::", $value->controller);
            $controllerName = $myTab[0];//on acdède au controlleur
            $method = $myTab[1];//on acdède à la methode
            $controller = new $controllerName(); // recherche la classe a instancier dans le chemin controller
            $response = $controller->{$method}(); // on appel la methode en cours dans l'iteration. {..} car c'est dynamique
            unset($controller);
            //$response
          break; //si ca a matché on sort de la boucle
        }
    }
    
    if(!isset($response)){
        $response = new Response();
        $response->setStatus(404, "Not Found");
        $response->addHeader("Content-Type", "text/html; charset=utf-8");
        $response->setBody("Not Found!");
    }

    
    header($response->getStatus());  //envoi avec header
    //toutes les autres entetes
    foreach ($response->getHeader() as $key => $value){
        header($key . ": " .$value); //formatage d'une entete
    }
    
    //Envoyer le body avec echo
    echo $response; // va indiquer toString qui invoque Body
    
    

} catch (Throwable $e) {
    
    header("HTTP/1.1 500 Internal Server Error");
    header("Content-Type: text/html; charset=utf-8");
    
    die(
        "<h1>"
        . "<b>Erreur</b>: " . $e->getMessage() . " "
        . "<b>line</b>: ". $e->getLine() . " "
        . "<b>file</b>: ". $e->getFile() . " "
        ."</h1>"
        );
    
}


 
 //var_dump($url);
 //var_dump($path);
 
 // verification si l'url correspond au path en cours d'itération
 
 
 
 
 
 //var_dump($routing);
 
//$response->setBody("Hellooo");

// echo $response->getBody();
// ou
// echo $response; //invoque la methode magique __toString qui invoque getBody()

//var_dump($response->attributExistepas); // la methode magique __get renvoi ce qu'elle a prévue

//$response->attributExistepas = true; // la methode magique __set



/***** Les controllers devront formater la réponse ******/
//$response = new Response();
// $response->setStatus(404, "pas trouvé");
// $response->addHeader("Content-Type", "application/json; charset=utf8");
// $response->setBody('{"message": "hello"}');

// //le front controller devra printer la réponse : no side effect
// //on envoi la reponse au client:

// //Entete avec le satus
// header($response->getStatus());  //envoi avec header

// //toutes les autres entetes
// foreach ($response->getHeader() as $key => $value){
//     header($key . ": " .$value); //formatage d'une entete
// }

// //Envoyer le body avec echo
// echo $response; // va indiquer toString qui invoque Body

/**********************************************************/

