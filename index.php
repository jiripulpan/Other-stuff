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
}
class ChildClass extends ParentClass {
    public $propChild = 'I am Child class';
}
$childObject = new ChildClass();
echo '<br><b>Property from parent: </b>';
echo $childObject->prop;

// __destruct automatically
echo '<br><b>$object gets destroyed on the end of the script automatically </b>';
?>