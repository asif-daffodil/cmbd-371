<?php
class Counter {
    public int $value = 0;
    public function inc(): static { $this->value++; return $this; }   // method chaining
}

$a = new Counter();
$b = new Counter();          // alada instance, alada data
$a->inc()->inc()->inc();     // chaining
$b->inc();
echo $a->value . ' ' . $b->value . PHP_EOL;     // 3 1

var_dump($a instanceof Counter);                 // true
echo get_class($a) . PHP_EOL;

// Dynamic class name
$className = 'Counter';
$c = new $className();

// Anonymous class
$anon = new class { public function hi() { return 'Hi from anon'; } };
echo $anon->hi() . PHP_EOL;

// Object theke array/stdClass
$obj = new stdClass();
$obj->name = 'Asif';
$obj->city = 'Dhaka';
print_r((array) $obj);

// EXERCISE: 3ta Product object banan, array te rekhe foreach e price print korun.
