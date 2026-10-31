<?php
class Vehicle {
    public function __construct(protected string $name, protected int $wheels = 4) {}

    public function describe(): string {
        return "{$this->name} has {$this->wheels} wheels";
    }
    public function start(): string { return "{$this->name} starts"; }
}

class Bike extends Vehicle {                       // extends = inherit
    public function __construct(string $name) {
        parent::__construct($name, 2);             // parent constructor manually call
    }
    public function wheelie(): string { return "{$this->name} does a wheelie!"; }   // new method
}

class ElectricCar extends Vehicle {
    public function __construct(string $name, private int $battery = 100) {
        parent::__construct($name);
    }
    public function start(): string {              // override
        return parent::start() . " silently (battery {$this->battery}%)";
    }
}

$b = new Bike('Yamaha');
$e = new ElectricCar('Tesla');
echo $b->describe() . PHP_EOL;     // parent theke pawa method
echo $b->wheelie() . PHP_EOL;
echo $e->start() . PHP_EOL;

var_dump($e instanceof Vehicle);   // true
print_r(class_parents($e));

// PHP e single inheritance (ekta-i parent). Multiple er jonno interface/trait.
// Multilevel: A -> B -> C hote pare.
// EXERCISE: Person -> Teacher -> HeadTeacher 3 level hierarchy banan.
