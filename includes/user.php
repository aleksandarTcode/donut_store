<?php
require_once("functions.php");
class User {
    public $database;
    public $username;
    public $password;
    public $role;
    public $role_session;
    public $idB;

    public function __construct($data_base)
    {
        $this->database = $data_base;

    }

   public function __set($name, $value)
{
    $this->$name = $value;
}

public function __get($name)
{
    return $this->$name;
}

    public function login_user(){

        $this->username = test_input($_POST['username']);
        $this->password = test_input($_POST['password']);

        try{
        $stmt = $this->database->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute(array($this->username));

        $result = $stmt->setFetchmode(PDO::FETCH_OBJ);
        $row = $stmt->fetchAll();



        if($stmt->rowCount()!==0){
            $this->role = $row[0]->role;
            $this->role_session = $_SESSION['role'] = $row[0]->role;
            if($row[0]->username == $this->username && $row[0]->password == $this->password && $this->role == 'buyer'){
                $_SESSION['username'] = $this->username;
                $_SESSION['firstname'] = $row[0]->firstname;
                $_SESSION['lastname'] = $row[0]->lastname;
                $_SESSION['idB'] = $row[0]->idB;
                header("Location: index.php");
            }else if($row[0]->username == $this->username && $row[0]->password == $this->password && $this->role == 'worker'){
                $_SESSION['username'] = $this->username;
                header("Location: orders_list.php");
            }
            else{
                set_message("Your Password is wrong!");
                $_SESSION['username_temp'] = $_POST['username'];
                $_SESSION['password_temp'] = $_POST['password'];
                header("Location: login.php");
            }
        }else {
            set_message("Your Username or Password is wrong!");
            $_SESSION['username_temp'] = $_POST['username'];
            $_SESSION['password_temp'] = $_POST['password'];
            header("Location: login.php");
        }

    }catch(PDOException $e){
            echo "Error: ". $e->getMessage();
        }

    }


}//end User class





?>