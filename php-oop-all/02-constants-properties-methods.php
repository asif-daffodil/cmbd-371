<?php
class Circle {
    const PI = 3.14159;                 // class constant (ager $ lage na)
    public float $radius = 1.0;         // property
    public static int $count = 0;       // static property

    public function area(): float {     // method
        return self::PI * $this->radius ** 2;
    }
    public function setRadius(float $r): void {
        $this->radius = $r;
    }
}

$c = new Circle();
$c->setRadius(5);
echo $c->area() . PHP_EOL;
echo Circle::PI . PHP_EOL;              // constant e object lage na
echo $c->radius . PHP_EOL;

// Typed + readonly property (PHP 8.1)
class Book {
    public function __construct(public readonly string $title) {}
}
$b = new Book('PHP OOP');
// $b->title = 'x';   // Error: readonly

// EXERCISE: Rectangle class banan (width, height property, area() ar perimeter() method).
