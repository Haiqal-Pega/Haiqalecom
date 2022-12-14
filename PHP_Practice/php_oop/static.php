<?php
echo "<h1 style='text-align:center'>PHP OOP Static Method</h1>";
class greeting {
  public static function welcome() {
    echo "Method called without creating an instance of the class<br>";
  }
  public function __construct() {
    self::welcome();
  }
}
class SomeOtherClass { //static method can be accessed form another class
    public function message() {
        greeting::welcome();
    }
  }
// Call static method
greeting::welcome();

echo "<bR>access statis method within the class itself using self keyword and ::<BR>";
new greeting(); 

?>

<?php
//calling static method from child class
class domain {
  protected static function getWebsiteName() {
    return "W3Schools.com";
  }
}

class domainW3 extends domain {
  public $websiteName;
  public function __construct() {
    $this->websiteName = parent::getWebsiteName(); //must use parent keyword to 
                                                //access statis function in parent class
  }
}

$domainW3 = new domainW3;
echo $domainW3 -> websiteName;

echo "<h1 style='text-align:center'>PHP OOP Static Properties</h1>";

class pi {
    public static $value=3.14159;
    public function staticValue() {
      return self::$value;
    }
  }

class x extends pi {
  public function xStatic() {
    return parent::$value;
  }
}
  
    // Get static property
    $pi = new pi();
    echo $pi->staticValue() ."<br>"; //accessing static property from self class
    echo pi::$value."<br>"; //directly access static properties

    // Get value of static property directly via child class
    echo x::$value."<br>";

    // or get value of static property via xStatic() method
    $x = new x();
    echo $x->xStatic();
?>

