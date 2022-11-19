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

//            print_r(get_object_vars($this));

        }catch (PDOException $e){
            echo "Error: ". $e->getMessage();
        }
    }

    public function get_all_orders(){

        $sql_query = "SELECT orders.item,orders.address,orders.payment_method,orders.price,orders.status,orders.date,CONCAT(users.firstname,' ',users.lastname) AS name FROM orders INNER JOIN users ON orders.idb=users.idb ORDER BY date DESC ;";
        $stmt = $this->database->conn->prepare($sql_query);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
        $row = $stmt->fetchAll();
        return $row;
    }

    public function get_all_with_pagination()
    {

        $total_entries = count($this->get_all_orders());
        $perPage = 2;

        //set page in url to 1 if it is set to non number
        if (isset($_GET['page'])) {
            $page = preg_replace('/[^0-9]/', '', $_GET['page']);
        } else {
            $page = 1;
        }

        $lastPage = ceil($total_entries / $perPage);

        // if someone is changing page in url manually
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $lastPage) {
            $page = $lastPage;
        }

        $middleNumbers = '';
        $sub1 = $page - 1;
        $sub2 = $page - 2;
        $add1 = $page + 1;
        $add2 = $page + 2;

        if ($page == 1) {
            $middleNumbers .= '<li class="page-item active"><a class="page-link">' . $page . '</a></li>';

            $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';

        } elseif ($page == $lastPage) {

            $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';

            $middleNumbers .= '<li class="page-item active"><a class="page-link">' . $page . '</a></li>';

        } elseif ($page > 2 && $page < ($lastPage - 1)) {
            $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub2 . '">' . $sub2 . '</a></li>';

            $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';

            $middleNumbers .= '<li class="page-item active"><a class="page-link">' . $page . '</a></li>';

            $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';

            $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add2 . '">' . $add2 . '</a></li>';

        } elseif ($page > 1 && $page < $lastPage) {
            $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $sub1 . '">' . $sub1 . '</a></li>';

            $middleNumbers .= '<li class="page-item active"><a class="page-link">' . $page . '</a></li>';

            $middleNumbers .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $add1 . '">' . $add1 . '</a></li>';

        }


        $outputPagination = '';

        if ($page != 1) {
            $prev = $page - 1;
            $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $prev . '">Back</a></li>';
        }

        $outputPagination .= $middleNumbers;

        if ($page != $lastPage) {
            $next = $page + 1;
            $outputPagination .= '<li class="page-item"><a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $next . '">Next</a></li>';
        }

        echo "<div class='text-center' style='clear: both'><ul class='pagination'>{$outputPagination}</ul></div>";

        $limit = 'LIMIT ' . ($page - 1) * $perPage . ',' . $perPage;

        try {

            $sql_query = "SELECT orders.id, orders.item,orders.address,orders.payment_method,orders.price,orders.status,orders.date,CONCAT(users.firstname,' ',users.lastname) AS name FROM orders INNER JOIN users ON orders.idb=users.idb ORDER BY date DESC {$limit}";
            $stmt = $this->database->conn->prepare($sql_query);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_OBJ);

            if ($total_entries !== 0) {

                while ($row = $stmt->fetch()) {
                    $table = <<<DELIMITER
                <tr>
                    <td>{$row->item}</td>
                    <td>{$row->name}</td>
                    <td>{$row->address}</td>
                    <td>{$row->payment_method}</td>
                    <td>{$row->date}</td>
                    <td>{$row->price}</td>
                    <td>{$row->status}</td>
                    <td><a href="orders_list.php?delete_id={$row->id}"  class="btn btn-danger btn-block" name="register" onClick="return confirm('Are you sure you want to delete?')">Delete</a> <a href="orders_list.php?approve_id={$row->id}"  class="btn btn-outline-success btn-block" name="register" onClick="return confirm('Are you sure you want to approve?')">Approve</a> <a href="orders_list.php?deny_id={$row->id}"  class="btn btn-outline-warning btn-block" name="register" onClick="return confirm('Are you sure you want to deny?')">Deny</a></td>
                </tr>
                DELIMITER;
                    echo $table;
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();

        }






    }//end get_all_with_pagination()

    public function change_order_status($status,$id){

        try{
            $stmt = $this->database->conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
            $stmt->execute(array($status,$id));
        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function delete_order($id){

        try{
            $stmt = $this->database->conn->exec("DELETE FROM orders WHERE id = {$id}");
        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }




}//end class Order

?>