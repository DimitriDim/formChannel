<?php
namespace App\Controller;

use App\Role\Role;
use App\Form\Form;
use App\Entity\Profile;
use App\DBH;
use App\Entity\Channel;
use App\Response;

class Home extends Controller
{

    public function Home()
    {
        $this->init();        
        if (Role::USER_VALUE !== $_SESSION["user"]->role) {
            return $this->renderDeafaultHome();
        }
        
        try {
            // s'il y a du get (info dans l'url)
            if (filter_input_array(INPUT_GET)) {
                $channelId = filter_input(INPUT_GET, "channel"); // nom dans l'url =>?channel dans listChannel.php
                $action = filter_input(INPUT_GET, "action"); // nom dans l'url =>&action dans listChannel.php
                
                if ($action === "delete") {
                    
                    if (! $this->testChannel($channelId)) { // test exitance du channel ou profil
                        throw new \Error("Channel or profil don't find");
                    } else if (! $this->deleteChannel($channelId)) {
                        throw new \Error("you can't delete this channel");
                    }
                    // remettre l'url en post pour la suite
                    $response = new Response();
                    $response->addHeader("Location", "/formation-php/web/home");
                    return $response; // toujours return pour donner une reponseuau front controller pour réafficher
                }
            } else if (! $this->isValid($_SESSION["user"])) {} else if (! $this->createChannel()) {
                throw new \Error("create error in bdd");
            } else {
                $success = "Your channel is create !";
            }
        } catch (\throwable $e) {
            
            // remettre l'url en post pour la suite
            // $response = new Response();
            // $response->addHeader("Location", "/formation-php/web/home");
            // return $response;
        }
        
        $mychannels = $this->channelProfil(); // on affiche quoi qu'il arrive la liste de channel
        
        return $this->render("/channel/owner.channel.html.php", [
            "user" => $_SESSION["user"],
            "mychannels" => isset($mychannels) ? $mychannels : [],
            "error" => isset($e) ? $e : null, // on lui passe le message à la vue
            "success" => isset($success) ? $success : null
        ]);
    }

    public function renderDeafaultHome()
    {
        return $this->render("home.html.php", [
            "user" => $_SESSION["user"]
        ]);
    }

    public function isValid($user)
    {
        
        // si rien n'est posté : false
        if (! filter_input_array(INPUT_POST)) { // si il n'y a pas de post
            return false;
        } // si le token n'est pas bon : exception
else if ($user->token !== filter_input(INPUT_POST, "token")) {
            throw new \Error("Invalid token");
        } // si un input pas rempli : exception
else if (! filter_input(INPUT_POST, Form::CHANNEL_NAME) || ! filter_input(INPUT_POST, Form::CHANNEL_DESCR)) {
            throw new \Error("Please complete the form");
        } else {
            return true;
        }
    }

    private function createChannel()
    {
        if ([] === DBH::get(DBH::DOCTRINE)->getRepository(Channel::class)->findBy([
            "channelName" => filter_input(INPUT_POST, Form::CHANNEL_NAME)
        ])) // verifie l'existance dans la bdd
{
            
            // création d'un profil qui recupere les infos de $_SESSION["user"]->profile
            $profile = DBH::get(DBH::DOCTRINE)->find(Profile::class, $_SESSION["user"]->profile);
            
            $channel = new Channel();
            $channel->setChannelName(filter_input(INPUT_POST, Form::CHANNEL_NAME));
            $channel->setChannelDescr(filter_input(INPUT_POST, Form::CHANNEL_DESCR));
            $channel->setChannelCapacity(filter_input(INPUT_POST, Form::CHANNEL_CAPACITY));
            $channel->setProfile($profile);
            
            /**
             * ** insérer ***
             */
            DBH::get(DBH::DOCTRINE)->persist($channel);
            DBH::get(DBH::DOCTRINE)->flush();
        } else {
            return false;
        }
        
        return true;
    }

    private function channelProfil()
    {
        $profile = DBH::get(DBH::DOCTRINE)->find(Profile::class, $_SESSION["user"]->profile);
        $channelCollection = DBH::get(DBH::DOCTRINE)-> // select infos multiple
getRepository(Channel::class)->findBy([
            "profile" => $profile
        ]); // dans Channel, attribut profile = 'profile_id'
        
        return $channelCollection;
    }

    private function deleteChannel($id)
    {
        $profile = DBH::get(DBH::DOCTRINE)->find(Profile::class, $_SESSION["user"]->profile);
        $channel = DBH::get(DBH::DOCTRINE)->find(Channel::class, $id);
        
        // Verifier que le profil qui supprime est bien celui qui à créé le channel a la base (car on est en get)
        if ($profile->getProfileId() == $channel->getProfile()->getProfileId()) { // on compare les attributs entre eux
            DBH::get(DBH::DOCTRINE)->remove($channel);
            DBH::get(DBH::DOCTRINE)->flush();
            return true;
        }
        return false;
    }

    private function testChannel($id)
    {
        if (! DBH::get(DBH::DOCTRINE)->find(Channel::class, $id)) {
            return false;
        }
        return true;
    }
}