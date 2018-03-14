<?php
namespace App\Controller;

use App\Form\Form;
use App\Model\User;
// use App\PDOHandler;
use App\Model\Modele;
use App\DBH;

class Signup extends Controller
{

    public function signup()
    {
        $this->init(); // demarre la session, previent vol
        
        $user = new User();
        
        try {
            
            if (! $user->hydrate(filter_input_array(INPUT_POST))) {} else if ($user->token !== $_SESSION["user"]->token) { // empeche l'attaque par boot en verifiant le token
                throw new \Error("Invalid token");
            } 
            else if (! $user->email || ! $user->pswd || ! filter_input(INPUT_POST, Form::PSW_CONFIRM_NAME)) {
                
                throw new \Error("Please complete the form");
            } else if (! filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                throw new \Error("Please submit a valid email");
            } else if (! preg_match(Form::PSWD_REGEX, $user->pswd)) {
                throw new \Error("The password must contain UpperCase, LowerCase and Number");
            } else if ($user->pswd !== filter_input(INPUT_POST, Form::PSW_CONFIRM_NAME)) {
                throw new \Error("Please confirm correctly the password");
            } else if (! $this->create($user)) {
                throw new \Error("User already exists");
            } else {
                $success = "Your account is valide";
            }
        } catch (\throwable $e) {}
        
        return $this->render("signup.signup.html.php", [
            "token" => $_SESSION["user"]->token,
            "error" => isset($e) ? $e : null, // on lui passe le message à la vue
            "success" => isset($success) ? $success : null,
            "user" => $user
        ]);
    }

    /**
     *
     * @param User $user            
     * @throws \Error
     * @return boolean
     */
    public function update(\SplSubject $subject)
    {}

    private function create(User $user)
    {
        try {
            // récupération du pdo avec la méthode car on ne peut pas l'avoir avec le this
            DBH::get(DBH::PDO)->beginTransaction();
            $this->createProfile();
            $this->createUser($user);
            return DBH::get(DBH::PDO)->commit();
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

    /**
     *
     * @return boolean
     */
    private function createProfile(): bool
    {
        $sth = DBH::get(DBH::PDO)->prepare("INSERT INTO" . "`profile` (`profile_firstname`, `profile_name`, `profile_avatar`) " . "VALUES (NULL, NULL, NULL);");
        return $sth->execute();
    }

    /**
     *
     * @param User $user            
     * @return bool
     */
    private function createUser(User $user): bool
    
    {
        $id = DBH::get(DBH::PDO)->lastInsertId();
        
        $sth = DBH::get(DBH::PDO)->prepare("INSERT INTO" . "`user` (" . "    `user_pswd`, `user_email`, `user_profile`" . ")" . "VALUES (" . ":pswd, :email, :profile" . ");")
        ;
        
        $sth->bindValue(":pswd", password_hash($user->pswd, PASSWORD_DEFAULT));
        $sth->bindValue(":email", $user->email);
        $sth->bindValue(":profile", $id);
        return $sth->execute();
    }
}