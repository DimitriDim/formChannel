<?php

namespace App;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\DatabaseDriver;

use PDO;



/* doctrine possede PDO, mixe des deux ici => remplace anciennement PDOHandler qui est pour du natif seul */


class DBH
{
    
    
    const DOCTRINE=1, PDO=2;
    
    /**
     *
     * @var PDOHandler
     */
    private static $instance;
    
    /**
     * $em
     * @var unknown
     */
    private $em; // instance de Doctrine
    
    private function __construct(){
        
        $this->em = $this->buildEm();
        
        /* rajouter un espace de nom par defaut a toutes nos entités */
        $driver = new DatabaseDriver($this->em->getConnection()->getSchemaManager());
        $driver->setNamespace("App\\Entity\\");
        $this->em->getConfiguration()->setMetadataDriverImpl($driver);
        
    }
    
    
    public static function getInstance():self{  //sinon :self car classe en cours
        
        if(!self::$instance){
            self::$instance= new self();
        }
        return self::$instance;
    }
    
    public static function get($type) { //retourne doctrine ou pdo suivant argument recu
        
        return $type==self::DOCTRINE ? self::getInstance()->em //entity manager de doctrine
                    : self::getInstance()->em->getConnection()->getWrappedConnection(); //sinon return un objet de pdo
    }
    
    
    
    private function getParameters(){ //class vierge
        return json_decode(file_get_contents(__DIR__ . "/../app/config/parameters.json"));
    }
    
    
    private function buildEm(){
        
        $cfg = $this->getParameters();
        $user = $cfg->database_user;
        $pswd = $cfg->database_password;
        $dbname = $cfg->database_name;
        $host = $cfg->database_host;
        $charset = $cfg->charset;
        $dsn = $cfg->database_driver.":host=".$host.";dbname=".$dbname.";charset=".$cfg->charset;
        
        return EntityManager::create(
                [
                'driver'   => 'pdo_'.$cfg->database_driver,
                'user'     => $user,
                'password' => $pswd ,
                'dbname'   => $dbname,
                'enum'   => 'string',
                
            ],
            Setup::createXMLMetadataConfiguration([__DIR__."/Entity"], false)
            //Setup::createAnnotationMetadataConfiguration([__DIR__ . "/../../src/Entity"], false,null,null,false)   
            );
        

     
    }
    
    
}