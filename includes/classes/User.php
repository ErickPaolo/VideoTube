<?php
class User {

    private $con, $sqlData;

    public function __construct($con, $username) {
        $this->con = $con;

        $query = $this->con->prepare("SELECT * FROM users WHERE username = :un");
        $query->bindParam(":un", $username);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function isLoggedIn(){
        return isset($_SESSION["userLoggedIn"]);
    } 
    
    public function getUsername() {
        return $this->sqlData["username"];
    }

    public function getName() {
        return $this->sqlData["firstName"] . " " . $this->sqlData["lastName"];
    }

    public function getFirstName() {
        return $this->sqlData["firstName"];
    }

    public function getLastName() {
        return $this->sqlData["lastName"];
    }

    public function getEmail() {
        return $this->sqlData["email"];
    }

    public function getProfilePic() {
        return $this->sqlData["profilePic"];
    }

    public function getSignUpDate() {
        return $this->sqlData["signUpDate"];
    }

    public function isSubscribedTo($userTo){
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
        $username = $this->getUsername();
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $username);
        $query->execute();
        return $query->rowCount() > 0;
    }

    public function getSubscriberCount(){
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
        $username = $this->getUsername();
        $query->bindParam(":userTo", $username);
        $query->execute();
        return $query->rowCount() > 0;
    }

}
?>