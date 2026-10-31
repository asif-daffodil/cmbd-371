<?php
class User {
    public string $name;
    public int $age;

    // object toiri hoyar shathe shathe auto cholbe
    public function __construct(string $name, int $age = 18) {
        $this->name = $name;
        $this->age  = $age;
        echo "User created: $name\n";
    }
}
$u = new User('Rahim', 25);
$u2 = new User('Karim');       // age default 18
echo $u2->age . PHP_EOL;

// Constructor property promotion (PHP 8): chhoto kore likha
class Product {
    public function __construct(
        public string $title,
        public float $price = 0.0,
        protected int $stock = 0,
    ) {}
}
$p = new Product('Pen', 10.5);
echo $p->title . ' - ' . $p->price . PHP_EOL;

// Named arguments (PHP 8)
$p2 = new Product(title: 'Book', price: 250);

// EXERCISE: Employee class banan promotion diye (name, salary, department).
