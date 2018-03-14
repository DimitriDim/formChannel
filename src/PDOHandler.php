<?php

/* PDOHandler utiliser que pour du natif: sans Doctrine*/

/* plus utilisé depuis refactoring sur DBBH */
// namespace App;
// use stdClass;
// use PDO;

// class PDOHandler
// {
    
    
//     /**
//      *
//      * @var PDOHandler
//      */ 
//     private static $instance;
    
//     /**
//      * $pdo
//      * @var unknown
//      */
//     private $pdo;
    
//     private function __construct(){

//         $this->pdo = $this->buildPDO();
        
//     }
    
    
//     public static function getInstance():PDOHandler{  //sinon :self car classe en cours
        
//         if(!PDOHandler::$instance){
//             PDOHandler::$instance= new PDOHandler();
//         }
//         return PDOHandler::$instance;
//     }
    
//     public static function getPdo(): PDO{ //retourne PDO
        
//         return PDOHandler::getInstance()->pdo;
//     }
    
    
    
//     private function getParameters(): stdClass{ //class vierge
//         return json_decode(file_get_contents(__DIR__ . "/../app/config/parameters.json"));
//     }
    
    
//     private function buildPDO():PDO{ //retourn PDO
        
//         $cfg = $this->getParameters();
        
//         $user = $cfg->database_user;
//         $pswd = $cfg->database_password;
//         $dbname = $cfg->database_name;
//         $host = $cfg->database_host;
//         $charset = $cfg->charset;
//         $dsn = $cfg->database_driver.":host=".$host.";dbname=".$dbname.";charset=".$cfg->charset;
        
//         return new PDO($dsn,$user,$pswd,[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);// les executions se feront en mode exception
        
       
//     }
    
    
// }