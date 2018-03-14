<?php

namespace App;

class Response
{
    
    private 
        /**
         * @var int
         */
        $statusCode,
        /**
         * @var int
         */
        $statusText,
        /**
         * @var array
         */
        $header,
        /**
         * @var string
         */
        $body;
    
    // constructeur en php
    public function __construct() // le __ permet de rajouter le nom de la classe entiere
    {
        $this->statusCode = 200;
        $this->statusText = "OK";
        $this->header = [];
        $this->body = "";
    }      
    
    public function setBody(string $body)
    {
        $this->body = $body;
    }
    
    public function getBody():string
    {
        return $this->body;
    }
    
    public function __toString()
    {
        return $this->getBody();
    }
    
    public function __get($name)
    {
        return property_exists($this, $name)
        ? $this->{$name}
        :null;
    }
    
    /**
     * 
     * $name est le nom de l'attribut (opérande 1)
     * $value est le nom de la valeur affecté (opérande 2)
     * 
     */
    
    public function __set($name, $value)
    {
        throw new \RuntimeException();
    }
    
    
    public function setStatus($code, $text)
    {
        $this->statusCode = $code;
        $this->statusText = $text;
    }
    
    public function getStatus():string
    {
        return "HTTP/1.1 " 
            . $this->statusCode 
            . " "
            . $this->statusText;
   
    }
    
    
    public function addHeader(string $name, string $value)
    {
        $this->header[$name] = $value; //ajout dans le tableau
 }
    
    public function getHeader(): array
    {
        return $this->header;
        
    }
    
    
    
    
}