<?php
class Test {
    // properties = variables
    public $ourProperty = 'I am here';
    public $prop;
    // protected = access only from inside object
    protected $ourProtectedProperty = 'I am here';
    // __construct 
    function __construct($var = null) {
        $this->prop = $var;
        $this->showMsg();
    }
    // __destruct after object is unset/destroyed
    function __destruct() {
        echo 'This is __destruct method';
    }
    // methods = functions, public by default
    function returnString() {
        echo 'From inside object '.$this->ourProperty; // $this = this object
    }
    function returnStringWithProtected() {
        echo 'From inside object '.$this->ourProtectedProperty; // $this = this object
    }
    function echoOut() {
        $this->returnString(); // same method
    }
    // getter and setter for protected properties
    function getProperty($prop) {
        return $this->$prop;
    }
    function setProperty($prop, $value) {
        $this->$prop = $value;
    }
    protected function showMsg() {
        echo 'I am __construct message';
    }
    // built in getter for properties that do not exist
    function __get($prop) {
        echo 'this property called '.$prop.' does not exist';
    }
    // built in setter for properties that do not exist
    function __set($prop, $value) {
        echo 'this property called '.$prop.' cant be set to value of '.$value;
    }
}
class ConstructorTest {
    public $constructorProperty;
    // static property belongs only to class
    static $ourStatic = 0;
    // __call for methods that does not exist
    function __call($method, $args) {
        echo $method.' does not exist';
        foreach($args as $value) {
            echo '<br>&emsp;<b>argument: </b>'.$value;
        }
    }
    // __toString to echo object
    function __toString() {
        return 'you requested me as string';
    }
    // constructor
    function __construct($value) {
        $this->constructorProperty = $value;
        // use self instead of $this
        self::$ourStatic++;
    }
    // static method works only with static properties or other static methods
    static function makeSomething($value) {
        return $value * self::$ourStatic;
    }
}
$object = new Test();
// data type of varible and other info
echo '<b>var_dump: </b>';
var_dump($object->ourProperty);

echo '<br><b>Public method: </b>';
echo $object->returnString();
echo '<br><b>Same method: </b>';
echo $object->echoOut();

// echo $object->ourProtectedProperty(); // error
echo '<br><b>Protected property method: </b>';
echo $object->returnStringWithProtected();

// get, set property with getter and setter and property name
$object->setProperty('ourProtectedProperty', 'I am there');
echo '<br><b>Get with getter: </b>';
echo $object->getProperty('ourProtectedProperty');

// property does not exist
echo '<br><b>Property does not exist: </b>';
echo $object->getProperty('noPropertyName');
echo '<br><b>Property cant be set: </b>';
echo $object->setProperty('noPropertyName', 'new value');

// constructor usage
$objectWithconstructor = new ConstructorTest('example');
echo '<br><b>Property set by constructor: </b>';
echo $objectWithconstructor->constructorProperty;

// static keyword usage
echo '<br><b>Static property value counting ConstructorTest objects: </b>';
echo ConstructorTest::$ourStatic;
echo '<br><b>Static method: </b>';
echo ConstructorTest::makeSomething(3);

// __call usage
echo '<br><b>Call method thats not there: </b>';
$objectWithconstructor->doesNotExistMethod('something', 'not', 123, 'there');

// __toString usage
echo '<br><b>echo object: </b>';
echo $objectWithconstructor;

// __construct usage
echo '<br><b>use of __construct: </b>';
$obj = new Test('This is property prop');
echo '<br>&emsp;';
echo $obj->prop;

// __destruct usage
echo '<br><b>$obj gets destroyed manually: </b>';
unset($obj);

// instanceof usage
echo '<br><b>Is $object instanceof Test: </b>';
if($object instanceof Test) {
    echo 'Yes';
}else{
    echo 'No';
}

// use of get_declared_classes()
echo '<br><b>All classes: </b></br>';
foreach(get_declared_classes() as $class){
    echo '&emsp;'.$class.'<br>';
}

// use of class_exists
echo '<br><b>Does class Test exists: </b>';
var_dump(class_exists('Test'));

// use of property_exists
echo '<br><b>Does property prop1 exists in $object: </b>';
var_dump(property_exists($object, 'prop1'));

// use of property_exists
echo '<br><b>Does method echoOut() exists in $object: </b>';
var_dump(method_exists($object, 'echoOut'));

// use of get_class_vars
echo '<br><b>All class vars of Test: </b>';
var_dump(get_class_vars('Test'));

// use of extends
class ParentClass {
    public $prop = 'I am Parent class';
    private $privateProp = 'I am Parent private property';
    static $staticProp = 'I am static from Parent';
    function getPrivateProp() {
        return $this->privateProp;
    }
    function __construct() {
        self::$staticProp = 100;
    }
    final function finalFunc() {
        echo 'Final function called';
    }
    public function overrideThis() {
        echo 'Override this functions echo<br>';
    }
}
class ChildClass extends ParentClass {
    public $propChild = 'I am Child class';
    function __construct() {
        self::$staticProp = 'I am static from Child';
    }
    function overrideThis() {
        parent::overrideThis();
        echo '&emsp;Overridden function from parent';
    }
}
class GrandChildClass extends ChildClass {
    function getProp() {
        return self::$staticProp; // object is created from parent to child and then grandchild
    }
}
$grandChildObject = new GrandChildClass();
echo '<br><b>Parent property from grand child: </b>';
echo $grandChildObject->prop;
echo '<br><b>Static property from grand child: </b>';
echo $grandChildObject->getProp();

// child cant inherit from final class
// parent::__construct(args) from child __construct(args)

// private is as protected but cant be inherited
echo '<br><b>Private property from inherited Parent class: </b>';
echo $grandChildObject->getPrivateProp();

// final function call, final function cant be overridden
echo '<br><b>Call final function from parent: </b>';
$grandChildObject->finalFunc();

// overriding example
echo '<br><b>Override example: </b>';
$grandChildObject->overrideThis();

// abstract class cant be instantiated with new keyword
// abstract is to force programmer to implement classes with predefined function content
abstract class ParentAbstractClass {
    public $property;
    function __construct() {
        $this->property = 'Value set by constructor';
    }
    // declared only in abstract classes
    abstract function abstractMethod();
}
class Child extends ParentAbstractClass {
    function abstractMethod() {
        echo 'This is abstract method set';
    }
}
$childObject = new Child();
echo '<br><b>Abstract class child: </b>';
echo $childObject->property;

// abstract function
echo ' <br><b>Abstract method example: </b>';
$childObject->abstractMethod();

// interface is only to force programmer to implement specific classes
interface Description {
    // constants
    const FIRSTNAME = 'John';
    // non-defined methods
    function weight();
    function height();
    function width();
}
interface OtherDescription {
    const MIDDLENAME = 'Darius';
}
// with trait dont have to implement and we can override functions
trait DescriptionTrait {
    public $car = 'Tesla';
    function getCar() {
        return $this->car;
    }
}
class TestClass implements Description, OtherDescription {
    use DescriptionTrait; // use trait to use its content
    const LASTNAME = 'Wicked';
    function weight() {
        echo 'Weight function';
    }
    function height() {
        echo 'Weight function';
    }
    function width() {
        echo 'Weight function';
    }
}
$newObject = new TestClass();
echo '<br><b>Implemented interface constant: </b>';
echo TestClass::MIDDLENAME;
echo '<br><b>Use keyword example: </b>';
echo $newObject->getCar();

echo '<br>';
// mysql OOP login example
class Login {
    protected $server = 'localhost';
    protected $user = 'root';
    protected $pass = '';
    protected $db = 'oop_example';
    protected $conn;
    public $errors = array();

    function __construct() {
        $this->conn = mysqli_connect($this->server, $this->user, $this->pass, $this->db);
    }
    protected function checkInput($var) {
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripslashes($var);
        return $var;
    }
    public function insertIntoTb($uname, $upass) {
        $username = $this->checkInput($uname);
        $userpass = $this->checkInput($upass);
        // call for errors checking
        if($this->checkErrors($username, $userpass)) {
            // check for username in DB
            if($this->checkUsername($username)) {
                // method for insertion into DB
                if($this->insertDB($username, $userpass)) $this->errors = ['Successfully inserted into DB'];
            }
        }
    }
    protected function checkErrors($uname, $upass) {
        if(strlen($uname) > 10) {
            array_push($this->errors, 'Username has more than 10 characters');
            return false;
        }
        if(strlen($upass) < 4) {
            array_push($this->errors, 'Password has less than 4 characters');
            return false;
        }
        return true;
    }
    protected function insertDB($uname, $upass) {
        $query = "INSERT INTO users(uname, upass) VALUES('".$uname."', '".$upass."')";
        mysqli_query($this->conn, $query);
        if(mysqli_affected_rows($this->conn) > 0) {
            return true;
        }else{
            return false;
        }
    }
    protected function checkUsername($username) {
        $query = "SELECT uname from users where uname='".$username."'";
        mysqli_query($this->conn, $query);
        if(mysqli_affected_rows($this->conn) > 0) {
            array_push($this->errors, "Username already in our DB");
            return false;
        }else{
            return true;
        }
    }
}
if(isset($_POST['send'])) {
    $login = new Login();
    $login->insertIntoTb($_POST['username'], $_POST['password']);
    foreach($login->errors as $error) {
        echo $error;
    }
}
?>
<!-- html form -->
<form method='post' action='#'>
    <input type='text' name='username'>
    <input type='password' name='password'>
    <input type='submit' name='send'>
</form>
<?php
// __destruct automatically
echo '<br><b>$object gets destroyed on the end of the script automatically: </b>';
?>