<?php

namespace App\Model;



class Modele {
    

    public function __get($name)
    {
        return property_exists($this, $name)
        ? $this->{$name}
        :null;
    }
    
    /**
     * @param string $name
     * @param mixed $value
     */
    
    public function __set($name,$value) // on set la valeur le nom exist (remplce tous les setter)
    {
        if(property_exists($this, $name)){
            $this->{$name} = $value;
        }
        
    }
    
    public function hydrate($inputArray):bool{

        if(!$inputArray){
            return false;
        }
        foreach ($inputArray as $key => $value){
            var_dump($inputArray);
            $this->__set($key, $value);
        }

        return true;
        
    }

   
  }
    
    
