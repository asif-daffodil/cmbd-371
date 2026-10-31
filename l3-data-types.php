<?php  
    // String
    $string = "Hello, World!";
    var_dump($string);

    // Integer
    $integer = 42;
    var_dump($integer);

    // Float
    $float = 3.14;
    var_dump($float);

    // Boolean
    $boolean = true;
    var_dump($boolean);

    // Array
    $array = [1, 2, 3, 4, 5];
    var_dump($array);

    // Object
    class Person {
        public $name = "John Doe";
        public $age = 30;
    }

    $person = new Person();
    var_dump($person);

    // Null
    $nullValue = null;
    var_dump($nullValue);

    // Resource
    $file = fopen("./l1-syntex.php", "w");
    var_dump($file);
?>