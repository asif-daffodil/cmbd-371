<?php
// abstract class: nijer object banano jay na, child ke abstract method implement korte hoy
abstract class Shape {
    public function __construct(protected string $name) {}

    abstract public function area(): float;   // body nai

    // concrete method: shob child use korbe
    public function describe(): string {
        return sprintf("%s area = %.2f", $this->name, $this->area());
    }
}
class Circle extends Shape {
    public function __construct(private float $r) { parent::__construct('Circle'); }
    public function area(): float { return M_PI * $this->r ** 2; }
}
class Rectangle extends Shape {
    public function __construct(private float $w, private float $h) { parent::__construct('Rectangle'); }
    public function area(): float { return $this->w * $this->h; }
}

foreach ([new Circle(5), new Rectangle(4, 6)] as $s) {
    echo $s->describe() . PHP_EOL;
}

try {
    $x = new Shape('x');   // Error!
} catch (Error $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

// abstract class vs interface:
//  - abstract class e property + concrete method thakte pare, single inheritance
//  - interface e shudhu contract, multiple implement kora jay
// EXERCISE: Triangle class banan (area = 0.5 * base * height).
