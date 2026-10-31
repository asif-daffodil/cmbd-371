<?php
class Address { public function __construct(public string $city) {} }
class Person {
    public function __construct(public string $name, public Address $address) {}

    // Shallow clone e nested object shared thake. Deep copy er jonno __clone
    public function __clone() {
        $this->address = clone $this->address;
    }
}

$p1 = new Person('Rahim', new Address('Dhaka'));
$p2 = clone $p1;           // __clone chole
$p2->name = 'Karim';
$p2->address->city = 'Sylhet';

echo $p1->name . ' - ' . $p1->address->city . PHP_EOL;   // Rahim - Dhaka
echo $p2->name . ' - ' . $p2->address->city . PHP_EOL;   // Karim - Sylhet

// __clone comment kore dekhun: p1 er city-o Sylhet hoye jabe (shallow copy)

// EXERCISE: Order class (items array of objects) banan, deep clone korun.
