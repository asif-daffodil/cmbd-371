<?php
// Class = blueprint (naksha), Object = oi naksha theke banano jinis.
class Car {
    // property (variable) ar method (function) class er vitore thake
    public string $brand = 'Toyota';

    public function drive(): string {
        return "{$this->brand} is driving";   // $this = current object
    }
}

$car = new Car();            // class theke object toiri
echo $car->drive() . PHP_EOL;
echo $car->brand . PHP_EOL;

// Class er nam convention: PascalCase (Car, UserProfile). File e ek class thakle bhalo.
// EXERCISE: Student class banan (name property, introduce() method).
