<?php
include_once("functions.php");
class User {
    public $database;
    public $username;
    public $password;
    public $role;
    public $role_session;

    public function __construct($data_base)
    {
        $this->database = $data_base;

    }

    public function login_user(){
        $this->username = test_input($_POST['username']);
        $this->password = test_input($_POST['password']);

        $stmt = $this->database->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute(array($this->username));

        $result = $stmt->setFetchmode(PDO::FETCH_OBJ);
        $row = $stmt->fetchAll();

        if($stmt->rowCount()!==0){
            $this->role = $row[0]->role;
            $this->role_session = $_SESSION['role'] = $row[0]->role;
            if($row[0]->username == $this->username && $row[0]->password == $this->password && $this->role == 'buyer'){
                $_SESSION['username'] = $this->username;
                header("Location: index.php");
            }else if($row[0]->username == $this->username && $row[0]->password == $this->password && $this->role == 'worker'){
                $_SESSION['username'] = $this->username;
                header("Location: orders_list.php");
            }
            else{
                set_message("Your Password is wrong!");
                header("Location: login.php");
            }
        }else {
            set_message("Your Username or Password is wrong!");
            header("Location: login.php");
        }

    }





}//end User class





?>