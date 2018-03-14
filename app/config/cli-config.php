<?php

/*modifié depuis que bootstrap à été retiré et deplacé dans DBH.php */

// replace with file to your own project bootstrap
//require __DIR__ . '/bootstrap.php'; avant quand bootstrap.php existait
use  App\DBH;
require __DIR__ . "/../../vendor/autoload.php";

// dcréation d'un objet de typer console, passant au get la const DOCTRINE
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(\App\DBH::get(DBH::DOCTRINE));

