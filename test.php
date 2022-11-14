<?php

//class Singleton {
//    public static $instance;
//
//    private function __construct(){}
//
//    public static function getInstance(){
//        if(!self::$instance)
//            self::$instance = new Singleton();
//        return self::$instance;
//    }
//}





//class Pravougaonik {
//    public $a;
//    public $b;
//    public function __construct($a,$b)
//    {
//        $this->a = $a;
//        $this->b = $b;
//    }
//    public function povrsina(){
//        return $this->a * $this->b;
//    }
//}
//
//class PravougaonikDecorator {
//    protected $pravougaonik;
//    protected $a;
//    protected $b;
//
//    public function __construct(Pravougaonik $pravougaonik){
//        $this->pravougaonik = $pravougaonik;
//        $this->a = $this->pravougaonik->a;
//        $this->b = $this->pravougaonik->b;
//    }
//
//    public function obim()
//    {
//        return 2*($this->a + $this->b);
//    }
//}
//
//$p = new Pravougaonik(2,5);
//echo $p->povrsina();
//echo "<br>";
//$s = "ss";
//$pd = new PravougaonikDecorator($p);
//echo $pd->obim();



$a = ['a','b'];
$b = [...$a,'c'];
print_r($b);
?>
