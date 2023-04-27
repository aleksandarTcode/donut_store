<?php
require_once("functions.php");
class User {
    public $database;
    public $mail;
    public $username;
    public $hashed_password;
    public $password;
    public $firstname;
    public $lastname;
    public $email;
    public $age;
    public $role;
    public $role_session;
    public $usernameErr = "";
    public $emailErr = "";
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

    public function add_user(){

        $this->username = test_input($_POST['username']);
        $this->email = test_input($_POST['email']);
        $this->hashed_password = $_SESSION['hashed_password'];
        try {
            $stmt = $this->database->conn->prepare("SELECT username,email FROM users WHERE username = ? OR email = ?;");
            $stmt->execute(array($this->username,$this->email));
            $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
            $row = $stmt->fetch();
//                print_r($row);
            if($stmt->rowCount()!==0 && $row->username == $this->username){
                $this->usernameErr = "Username is already taken!";
            }else if($stmt->rowCount()!==0 && $row->email == $this->email){
                $this->emailErr = "Email is already taken!";
            }
            else {
                $stmt = $this->database->conn->prepare("INSERT INTO users (username,password,email,firstname,lastname,age) VALUES (:username,:password,:email,:firstname,:lastname,:age)");
                $stmt->bindParam(':username',$this->username);
                $stmt->bindParam(':password',$this->hashed_password);
                $stmt->bindParam(':email',$_SESSION['email']);
                $stmt->bindParam(':firstname',$_SESSION['first_name']);
                $stmt->bindParam(':lastname',$_SESSION['last_name']);
                $stmt->bindParam(':age',$_SESSION['age']);

                $stmt->execute();

                //sending mail to user when register
                $this->mail->IsSMTP();
                $this->mail->Mailer = "smtp";
                $this->mail->SMTPDebug  = 1;
                $this->mail->SMTPAuth   = TRUE;
                $this->mail->SMTPSecure = "tls";
                $this->mail->Port       = 587;
                $this->mail->Host       = "smtp.gmail.com";
                $this->mail->Username   = "username";
                $this->mail->Password   = "password";

                //Recipients
                $this->mail->setFrom('sweethouse@example.com', 'Sweethouse');
                $this->mail->addAddress($_SESSION['email'], $_SESSION['first_name']." ".$_SESSION['last_name']);     //Add a recipient
//                $this->mail->addAddress('ellen@example.com');               //Name is optional
                $this->mail->addReplyTo('testingtrmcic@gmail.com', 'Aleksandar');
//                $this->mail->addCC('cc@example.com');
//                $this->mail->addBCC('bcc@example.com');

//                //Attachments
//                $this->mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//                $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $this->mail->isHTML(true);                                  //Set email format to HTML
                $this->mail->Subject = 'Successful registration!';
                $this->mail->Body    = "<h3>Dear {$_SESSION['first_name']}, thank you for registering on our store!</h3><br><p>Your <b>username</b> is: {$_SESSION['username']}</p><p>Your <b>password</b> is: {$_SESSION['password']}</p>";
                $this->mail->AltBody = 'Thank you for registering on our store!';

                try {
                $this->mail->send();
                echo 'Message has been sent';
                } catch (Exception $e){
                    //
                }

            }

        }catch (PDOException $e){
            echo "Error: ". $e->getMessage();
        }

    }//end add_user()

    
    public function login_user(){

        $this->username = test_input($_POST['username']);
        $this->password = test_input($_POST['password']);

        try{
        $stmt = $this->database->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute(array($this->username));

        $result = $stmt->setFetchmode(PDO::FETCH_OBJ);
        $row = $stmt->fetch();



        if($stmt->rowCount()!==0){
            $this->role = $row->role;
            $this->role_session = $_SESSION['role'] = $row->role;
            if($row->username == $this->username && password_verify($this->password,$row->password ) && $this->role == 'buyer'){
                $_SESSION['username'] = $this->username;
                $_SESSION['firstname'] = $row->firstname;
                $_SESSION['lastname'] = $row->lastname;
                $_SESSION['idB'] = $row->idB;
                header("Location: index.php");
            }else if($row->username == $this->username && password_verify($this->password,$row->password ) && $this->role == 'worker'){
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

    }//end login_user()


}//end User class




?>