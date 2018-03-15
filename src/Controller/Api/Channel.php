<?php
namespace App\Controller\Api;

use App\Response;
use App\Role\Role;
use App\DBH;
use App\Entity\Channel as ChannelEntity;
use App\Entity\Profile;
use App\Entity\ChannelProfile;
use App\Entity\Message;

class Channel extends ControllerApi
{

    public function channel(): Response
    {
        $this->init();

        // 1/ lire les entetes du client
        $accept = filter_input(INPUT_SERVER, "HTTP_ACCEPT");
        
        if ("application/json" !== $accept) {
            $this->response->setStatus(406, "Not Acceptable");
            
            // le user a t'il le role de user
        } 
        else if (Role::USER_VALUE !== $_SESSION["user"]->role) {
            $this->response->setStatus(401, "Unauthorized");
        }
        else if(!$this->isOwnerChannel($_SESSION["user"]) && !$this->isSuscribberChannel($_SESSION["user"])){
            $this->response->setStatus(403, "Forbidden");
        }
        else {
            $this->input();
        }

        return $this->response;
    }

    public function isOwnerChannel($user)
    {
        // le owner est il le créateur du channel
        return DBH::get(DBH::DOCTRINE)-> // select infos multiple
getRepository(ChannelEntity::class)->findOneBy([
            "channelId" => filter_input(INPUT_GET, "channel"),
            "profile" => DBH::get(DBH::DOCTRINE)->find(Profile::class, $user->profile)
        ]);
    }

    public function isSuscribberChannel($user)
    {
        // le user est il utilisateur du channel
        return DBH::get(DBH::DOCTRINE)-> // select infos multiple
getRepository(ChannelProfile::class)->findOneBy([
            "channel" => filter_input(INPUT_GET, "channel"),
            "profile" => DBH::get(DBH::DOCTRINE)->find(Profile::class, $user->profile)
        ]);
    }
    
    //permet de connaitre le type d'input (get, post ou ???)
    public function input()
    {
        
        $method=filter_input(INPUT_SERVER,"REQUEST_METHOD");
        if ($method=="GET"){
            $this->response->setStatus(200, "OK");
            $this->response->addHeader("Content-Type", "application/json");
            $this->response->setBody("{}");
            return $this->response;
        }
        else if ($method=="POST"){
            if(!filter_input_array(INPUT_POST)){
                $this->response->setStatus(400, "Bad Request");
                return $this->response;
            }
            $this->saveMessage();
            $this->response->setStatus(201, "Created");
            $this->response->addHeader("Content-Type", "application/json");
            $this->response->setBody("{}");
            return $this->response;
        }
        else 
        {
            $this->response->setStatus(405, "Method Not Allowed");
            return $this->response;
        }
    }
    
    public function saveMessage()
    {
        // création d'un profil qui recupere les infos de $_SESSION["user"]->profile
        $profile = DBH::get(DBH::DOCTRINE)->find(Profile::class, $_SESSION["user"]->profile);
        $idchannel = DBH::get(DBH::DOCTRINE)->find(ChannelEntity::class, filter_input(INPUT_GET, "channel"));
        
        $message = new Message();
        $message->setMessageText(filter_input_array(INPUT_POST)["message"]);
        $message->setProfile($profile);
        $message->setChannel($idchannel);
        $message->setTimestamp(time());

        /**
         * ** insérer ***
         */
        DBH::get(DBH::DOCTRINE)->persist($message);
        DBH::get(DBH::DOCTRINE)->flush();
        
    }
}