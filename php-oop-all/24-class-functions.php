<?php
class Animal { public $name = 'Generic'; protected $age = 2; public function speak() {} }
class Dog extends Animal { public $breed = 'Local'; public function fetch() {} }

$d = new Dog();
var_dump(class_exists('Dog'));                    // true
var_dump(method_exists($d, 'fetch'));             // true
var_dump(property_exists('Dog', 'age'));          // true (protected-o dhore)
var_dump(is_a($d, 'Animal'));                     // true
var_dump(is_subclass_of($d, 'Animal'));           // true
echo get_class($d) . PHP_EOL;                     // Dog
echo get_parent_class($d) . PHP_EOL;              // Animal
print_r(get_object_vars($d));                     // public property (scope onujayi)
print_r(get_class_methods('Dog'));                // method list
print_r(class_parents($d));                       // SPL
echo $d::class . PHP_EOL;                         // Dog

// Real use: dynamic method call
$method = 'speak';
if (method_exists($d, $method)) $d->$method();

// EXERCISE: ekta function banan jeta object nie tar shob public method er nam print kore.
