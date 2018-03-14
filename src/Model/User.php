<?php

namespace App\Model;

class User extends Modele{
    
    
    protected 
    
        /**
         * @var integer
         */
        $id,
        /**
         * @var integer
         */
        $profile,
        /**
         * @var integer
         */
        $ip,
        /**
         * @var string
         */
        $agent,
        /**
         * @var integer
         */
        $timestamp,
        /**
         * @var string
         */
        $email,
        /**
         * @var string
         */
        $pswd,
        /**
         * @var string
         */
        $role,
        /**
         * @var string
         */
        $token;

}