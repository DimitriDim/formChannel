<?php
namespace App\Controller;

use App\Form\Form;
use App\Role\Role;
use App\Model\User;
// use App\PDOHandler;
use App\Response;
use App\DBH;

class SignIn extends Controller
{

    public function signin()
    {
        $this->init(); // demarre session
        if ($_SESSION["user"]->role != Role::VISITOR_VALUE) {
            
            $response = new Response();
            $response->addHeader("Location", "/formation-php/web/home");
            return $response;
        }
        $oldToken = $_SESSION["user"]->token;
        $user = $_SESSION["user"];
        
        try {
            
            if (! $user->hydrate(filter_input_array(INPUT_POST))) {} else if ($user->token !== $oldToken) { // csrf
                throw new \Error("Invalid token");
            } else if (! $user->email || ! $user->pswd) {
                throw new \Error("Please complete the form");
            } else if (! filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                throw new \Error("Please submit a valid email");
            } else if (! $this->verify($user)) {
                throw new \Error("No user found");
            } else {
                
                // $_SESSION["user"]->email=null; // on vide l'émail par secrutité
                $_SESSION["user"]->pswd = null; // on vide le pswd par secrutité
                $success = "Your are enter";
            }
        } catch (\throwable $e) {}
        
        return $this->render("signin.signin.html.php", [
            "token" => $_SESSION["user"]->token,
            "error" => isset($e) ? $e : null, // on lui passe le message à la vue
            "success" => isset($success) ? $success : null,
            "user" => $user
        ]);
    }

    private function verify(User $user)
    {
        try {
            // récupération du pdo avec la méthode car on ne peut pas l'avoir avec le this
            DBH::get(DBH::PDO)->beginTransaction();
            return $this->verifyMail($user->email) && // on test opérande 1 si ok passage a la 2 sinon return false et levé d'execption
$this->verifyPswd($user->email, $user->pswd) && // on test opérande 2 si ok passage a la 3 sinon return false et levé d'execption
DBH::get(DBH::PDO)->commit() && // si ok on commit
$this->upgradeRoleBDD($user->email) && $this->saveProfile($user->email) && $this->upgradeRoleSession();
        } catch (\throwable $e) {
            echo $e;
            if (DBH::get(DBH::PDO)->inTransaction()) {
                DBH::get(DBH::PDO)->rollBack();
                return false;
            }
            DBH::get(DBH::PDO)->commit();
            throw new \Error("contact WebMaster");
        }
    }

    private function verifyMail($email)
    {
        $PDO = DBH::get(DBH::PDO);
        $sth = $PDO->prepare("SELECT COUNT(user_email) FROM user WHERE user_email = :email");
        $sth->bindValue(":email", $email); // pour éviter l'injection SQL
        $sth->execute();
        return $sth->fetch($PDO::FETCH_OBJ)->{"COUNT(user_email)"} === "1"; // true ou false si ["COUNT(user_email)"] = 1 ou 0
    }

    private function verifyPswd($email, $pswd)
    {
        $PDO = DBH::get(DBH::PDO);
        $sth = $PDO->prepare("SELECT user_pswd FROM user WHERE user_email = :email");
        $sth->bindValue(":email", $email); // pour éviter l'injection SQL
        $sth->execute();
        return password_verify($pswd, $sth->fetch($PDO::FETCH_ASSOC)["user_pswd"]);
    }

    private function upgradeRoleBDD($email)
    {
        $PDO = DBH::get(DBH::PDO);
        $sth = $PDO->prepare("UPDATE user SET user_role =" . Role::USER_VALUE . " WHERE user_email= :email ");
        $sth->bindValue(":email", $email); // pour éviter l'injection SQL
        
        return $sth->execute();
    }

    private function upgradeRoleSession()
    {
        return $_SESSION["user"]->role = Role::USER_VALUE;
    }

    private function saveProfile($email)
    {
        $PDO = DBH::get(DBH::PDO);
        $sth = $PDO->prepare("SELECT user_profile FROM user WHERE user_email = :email");
        $sth->bindValue(":email", $email); // pour éviter l'injection SQL
        $sth->execute();
        $_SESSION["user"]->profile = $sth->fetch($PDO::FETCH_ASSOC)["user_profile"];
        
        return $_SESSION["user"]->profile;
    }

    private function downgradeRole()
    {}
}