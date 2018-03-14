<?php

use App\Entity\User;
use App\Entity\Role;
use App\Entity\Profile;
use App\Entity\Channel;
use App\Entity\ChannelProfile;
use  App\DBH;

require __DIR__ . "/../vendor/autoload.php";


// $profile = DBH::get(DBH::DOCTRINE) ->find(Profile::class, 62);
// var_dump($profile->getProfileFirstname());

// $user = DBH::get(DBH::DOCTRINE) ->find(User::class, 63);
// var_dump($user->getProfileFirstname()->getRoleName());

/*****************************************************************************/

/**** insertions liés ****/

//il faut un profile qui vient de doctrine
// $profile = DBH::get(DBH::DOCTRINE) ->find(Profile::class, 62);

// $channel = new Channel();
// $channel->setChannelName("channel name");
// $channel->setChannelDescr("tchat");
// $channel->setChannelCapacity(15);
// $channel->setProfile($profile);


// /**** insérer ****/

// DBH::get(DBH::DOCTRINE)->persist($channel);
// DBH::get(DBH::DOCTRINE)->flush();

/*****************************************************************************/

/**** insertions liés ****/

// //il faut un profile qui vient de doctrine
// $profile = DBH::get(DBH::DOCTRINE) ->find(Profile::class, 62);
// $channel = DBH::get(DBH::DOCTRINE) ->find(Channel::class, 1);
// $channel_profile = new ChannelProfile();
// $channel_profile->setChannel($channel);
// $channel_profile->setProfile($profile);

// /**** insérer ****/

// DBH::get(DBH::DOCTRINE)->persist($channel_profile);
// DBH::get(DBH::DOCTRINE)->flush();

// /**** insertions liés ****/

// //il faut un profile qui vient de doctrine
// $profile = DBH::get(DBH::DOCTRINE) ->find(Profile::class, 64);
// $channel = DBH::get(DBH::DOCTRINE) ->find(Channel::class, 1);
// $channel_profile = new ChannelProfile();
// $channel_profile->setChannel($channel);
// $channel_profile->setProfile($profile);

// /**** insérer ****/

// DBH::get(DBH::DOCTRINE)->persist($channel_profile);
// DBH::get(DBH::DOCTRINE)->flush();

/*****************************************************************************/

// /**** insertions liés ****/

// //il faut un profile qui vient de doctrine
// $profile = DBH::get(DBH::DOCTRINE) ->find(Profile::class, 67);
// $channel = DBH::get(DBH::DOCTRINE) ->find(Channel::class, 1);
// $channel_profile = new ChannelProfile();
// $channel_profile->setChannel($channel);
// $channel_profile->setProfile($profile);

// /**** insérer ****/

// DBH::get(DBH::DOCTRINE)->persist($channel_profile);
// DBH::get(DBH::DOCTRINE)->flush();

/*****************************************************************************/

/*** suppression d'un channel profil */

// $channel_profile = DBH::get(DBH::DOCTRINE) ->find(ChannelProfile::class, 1);
// DBH::get(DBH::DOCTRINE)->remove($channel_profile);
// DBH::get(DBH::DOCTRINE)->flush();






// $user = DBH::get(DBH::DOCTRINE) ->find(User::class, 52);
// DBH::get(DBH::DOCTRINE)->remove($user);
// DBH::get(DBH::DOCTRINE)->flush();


$user = new User();
$user->setUserEmail("dimitri.test@gmail.com");
$user->setUserPswd("mdp");


DBH::get(DBH::DOCTRINE)->persist($user);
DBH::get(DBH::DOCTRINE)->flush();

exit;

// $user = new User;
// $role = new Role();
// $profile = new Profile();
// $user->setUserEmail("mail");
// $user->setUserPswd("pswd");
// $role->setRoleName("name");
// $profile->setProfileAvatar("avatar");
// $profile->setProfileFirstname("first");
// $profile->setProfileName("name");
// $user->setUserProfile($profile);
// $user->setUserRole($role);

// //pour la création
// $entityManager->persist($user);
// $entityManager->flush();

// $user = $entityManager->getRepository(User::class)->findOneBy(["userId" => 24]);
// var_dump($user->getUserProfile()->getProfileFirstname());
// var_dump($user->getUserRole()->getRoleName());

