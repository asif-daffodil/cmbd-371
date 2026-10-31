<?php
class Point {
    public function __construct(public int $x, public int $y) {}
}
$a = new Point(1, 2);
$b = new Point(1, 2);
$c = $a;

var_dump($a == $b);    // true  : same class + same property value
var_dump($a === $b);   // false : alada object
var_dump($a === $c);   // true  : same instance

$b->y = 5;
var_dump($a == $b);    // false

// instanceof
class Admin extends Point {}
var_dump(new Admin(0, 0) instanceof Point);    // true
var_dump($a instanceof Admin);                 // false

// Custom equality: nijer method banano bhalo
class Money {
    public function __construct(public int $amount, public string $cur) {}
    public function equals(Money $o): bool {
        return $this->amount === $o->amount && $this->cur === $o->cur;
    }
}
var_dump((new Money(100, 'BDT'))->equals(new Money(100, 'BDT'))); // true

// EXERCISE: duita alada class er object same property niye == diye compare korun.
