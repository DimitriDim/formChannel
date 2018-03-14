<?php
namespace App\Controller;

use App\Role\Role;
use App\Response;
use App\DBH;
use App\Entity\Profile;
use App\Entity\Channel as ChannelEntity;

class Channel extends Controller
{

    public function channel(): Response
    {
        $this->init();

        if (Role::USER_VALUE !== $_SESSION["user"]->role) {
            throw new \Error("can not acces to user pages");
        }
        
        try {
            if (! $this->testProfileChannel()) {
                throw new \Error("can not acces to this channel");
            }
        } catch (Exception $e) {
            return $this->renderDeafaultHome();
        }
        
        return $this->render("/channel/channel.html.php", [
            "user" => $_SESSION["user"],
            "mychannels" => isset($mychannels) ? $mychannels : [],
            "error" => isset($e) ? $e : null, // on lui passe le message à la vue
            "success" => isset($success) ? $success : null
        ]);
    }

    public function renderDeafaultHome()
    {
        return $this->render("home.html.php", 
            ["user" => $_SESSION["user"]
        ]);
    }

    public function testProfileChannel()
    {
        //dans Channel entity on verifie que l'id présent dans url (get) existe avec le profile de la session en cours
        return DBH::get(DBH::DOCTRINE)->getRepository(ChannelEntity::class)->findOneBy([
            "channelId" => filter_input(INPUT_GET, "id"),
            "profile" => DBH::get(DBH::DOCTRINE)->find(Profile::class, $_SESSION["user"]->profile)
        ]);
    }
}