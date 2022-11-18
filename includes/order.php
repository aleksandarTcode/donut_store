<?php
require_once("functions.php");


class Order {
    public $database;
    public $idB;
    public $item;
    public $address;
    public $paymentMethod;
    public $price;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __construct($data_base){
        $this->database = $data_base;
    }

    public function new_order(){

        //fill Order properties with SESSION values, exclude first one ($database)
        foreach(array_slice(get_object_vars($this),1) as $prop=>$value){
            if(array_key_exists($prop,$_SESSION)){
                $this->$prop = $_SESSION[$prop];
            }
        }
        try {
            $stmt = $this->database->conn->prepare("INSERT INTO orders (idB,item,address,payment_method,price) VALUES (:idB,:item,:address,:payment_method,:price)");
            $stmt->bindParam(':idB', $this->idB);
            $stmt->bindParam(':item', $this->item);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':payment_method', $this->paymentMethod);
            $stmt->bindParam(':price', $this->price);

            $stmt->execute();

            print_r(get_object_vars($this));

        }catch (PDOException $e){
            echo "Error: ". $e->getMessage();
        }


    }






}//end class Order

?>